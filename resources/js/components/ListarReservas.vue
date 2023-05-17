<template>
    <div>
        <table class="table" v-if="isLoading">
            <thead>
                <tr>
                    <th>Horário</th>
                    <th>Mesas </th>
                    <th>Cliente</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir os horários -->
                <tr v-for="reserva in listaDeReservas" :key="reserva.id">
                    <td>{{ formatarData(reserva.res_mesa) }}</td>
                    <td>Mesa {{ reserva.mesa.id }} ({{ reserva.mesa.lugares }} lugares)</td>
                    <td>{{ reserva.user.name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    data() {
        return {
            isLoading: false,
            listaDeReservas: [],
        };
    },
    mounted() {
        this.obterListaReservas();
    },
    methods: {
        obterListaReservas(dataSelecionada) {
            this.isLoading = false;
            axios.get('/lista-reservas')
                .then(response => {
                    this.isLoading = true;
                    this.listaDeReservas = response.data;
                })
                .catch(error => {
                    this.isLoading = true;
                    console.error(error);
                });
        },
        formatarData(data) {
            return moment.utc(data).format('DD/MM/YY HH:mm');
        },
    },
};
</script>
