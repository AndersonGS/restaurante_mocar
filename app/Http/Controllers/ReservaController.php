<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;
use App\Models\Mesa;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    public function mesasDisponiveis(Request $request)
    {
        $mesasDisponiveis = Mesa::all();
        $reservas = Reserva::all();
        $horaHoje = Carbon::now();

        $horarios = [];

        if ($request->has('dataReserva')) {
            $dataReserva = Carbon::parse($request->get('dataReserva'));
        } else {
            $dataReserva = Carbon::now()->setTime(18, 0, 0);
        }

        if ($dataReserva->dayOfWeek === Carbon::SUNDAY) {
            $abertura = $dataReserva->copy();
            $abertura->setTime(12, 0); // Define o horário de abertura (12:00)
            $fechamento = $dataReserva->copy();
            $fechamento->setTime(23, 59)->addMinutes(180); // Define o horário de fechamento (02:59)
        } else {
            $abertura = $dataReserva->copy();
            $abertura->setTime(18, 0); // Define o horário de abertura (18:00)
            $fechamento = $dataReserva->copy();
            $fechamento->setTime(23, 59); // Define o horário de fechamento (23:59)
        }

        $horarioAtual = $abertura->copy();;
        while ($horarioAtual->lte($fechamento)) {
            $horarios[] = Carbon::parse($horarioAtual->format('Y-m-d H:i'));
            $horarioAtual->addMinutes(90); // Adiciona 90 minutos para o próximo horário
        }

        $dados= [];
        foreach ($horarios as $horario) {
            if (!($horario->lte($horaHoje))) {
                $mesasDisponiveis = $mesasDisponiveis->filter(function ($mesa) use ($reservas, $horario) {
                    $reservaExistente = $reservas->first(function ($reserva) use ($mesa, $horario) {
                        return $reserva->mesa_id === $mesa->id && (Carbon::parse($reserva->res_mesa))->equalTo($horario);
                    });
                    return !$reservaExistente;
                });
                $dados[] = [
                    'horario' => $horario,
                    'mesas' => $mesasDisponiveis,
                ];
            }
        }

        return response()->json($dados);
    }


    public function fazerReserva(Request $request)
    {
        // Valide e processe os dados recebidos do formulário de reserva
        $request->validate([
            'mesa' => 'required',
            'horario' => 'required',
        ]);

        // Crie a reserva no banco de dados
        $reserva = new Reserva();
        $reserva->mesa_id = $request->mesa;
        $reserva->user_id =  Auth::id();
        $reserva->res_mesa = Carbon::parse($request->horario);
        $reserva->save();

        return response()->json(['message' => 'Reserva feita com sucesso']);
    }
}
