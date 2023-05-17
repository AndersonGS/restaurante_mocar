<template>
    <div>
        <b-form-group>
            <b-input-group>
                <b-form-datepicker v-model="dataSelecionada" placeholder="Selecione uma data"></b-form-datepicker>
                <b-input-group-append>
                    <b-button @click="buscarDados" variant="primary">Buscar</b-button>
                </b-input-group-append>
            </b-input-group>
        </b-form-group>
        <table class="table" v-if="isLoading">
            <thead>
                <tr>
                    <th>Horário</th>
                    <th>Mesas Disponíveis</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir os horários -->
                <tr v-for="horarios, index in horariosDisponiveis" :key="index">
                    <td>{{ formatarData(horarios.horario) }}</td>
                    <td>
                        <label class="ml-2 mb-0" v-for="mesa in horarios.mesas" :key="mesa.id">
                            Mesa {{ mesa.id }} ({{ mesa.lugares }} lugares)
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center" v-if="!isLoading">
            <b-spinner class="m-5" variant="primary" type="grow" label="Spinning"></b-spinner>
        </div>
        <hr>
        <form class="form-group" @submit.prevent="fazerReserva" v-if="isLoading">
            <h4>Escolha o horario e a mesa:</h4>

            <label for="horario">Horário:</label>
            <select class="form-control mb-1" id="horario" v-model="horarioSelecionado" @change="carregarListaMesas">
                <option v-for="horarios, index in horariosDisponiveis" :value="index" :key="index">
                    {{ formatarData(horarios.horario) }}
                </option>
            </select>

            <label for="mesa">Mesa:</label>
            <select class="form-control mb-3" id="mesa" v-model="mesaSelecionada">
                <option v-for="mesa in mesasDisponiveis" :value="mesa.id" :key="mesa.id">
                    Mesa {{ mesa.id }} ({{ mesa.lugares }} lugares)
                </option>
            </select>
            <b-button type="submit" variant="primary">Reservar</b-button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
import { BFormDatepicker, BButton, BInputGroup, BInputGroupAppend, BFormGroup, BSpinner } from 'bootstrap-vue';


export default {
    components: {
        BFormDatepicker,
        BButton,
        BInputGroup,
        BInputGroupAppend,
        BFormGroup,
        BSpinner,
    },
    data() {
        return {
            isLoading: false,
            horariosDisponiveis: [],
            mesasDisponiveis: [],
            mesaSelecionada: '',
            horarioSelecionado: '',
            dataAtual: moment(),
            dataSelecionada: moment().format('YYYY-MM-DD'),
        };
    },
    mounted() {
        this.obterHorariosDisponiveis(this.dataAtual.format('YYYY-MM-DD'));
    },
    methods: {
        obterHorariosDisponiveis(dataSelecionada) {
            this.isLoading = false;
            axios.get('/mesas-disponiveis?dataReserva=' + dataSelecionada)
                .then(response => {
                    this.isLoading = true;
                    this.horariosDisponiveis = response.data;
                })
                .catch(error => {
                    this.isLoading = true;
                    console.error(error);
                });
        },
        formatarData(data) {
            return moment.utc(data).format('HH:mm');
        },
        carregarListaMesas() {
            this.mesasDisponiveis = this.horariosDisponiveis[this.horarioSelecionado].mesas;
        },
        buscarDados() {
            this.obterHorariosDisponiveis(this.dataSelecionada)
            // console.log('Data selecionada:', this.dataSelecionada);
        },
        fazerReserva() {
            const reserva = {
                mesa: this.mesaSelecionada,
                horario: this.horariosDisponiveis[this.horarioSelecionado].horario,
            };
            this.isLoading = false;
            axios.post('/reserva', reserva)
                .then(response => {
                    // Reserva feita com sucesso
                    console.log('Reserva feita:', response.data);
                    this.mesaSelecionada = '';
                    this.horarioSelecionado = '';
                    // Atualizar mesas e horários disponíveis após a reserva
                    this.obterHorariosDisponiveis(this.dataSelecionada);
                })
                .catch(error => {
                    // Tratar erros ao fazer a reserva
                    this.isLoading = true;
                    console.error(error);
                });
        },
    },
};
</script>
