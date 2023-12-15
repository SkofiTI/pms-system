<template>
    <h1>Номера отеля</h1>

    <table>
        <thead>
            <th>Номер</th>
            <th>Категория</th>
            <th>Кол-во комнат</th>
            <th>Кол-во мест</th>
            <th>Кондиционер</th>
            <th>Телевизор</th>
            <th>Для курящих</th>
            <th>Балкон</th>
            <th>Этаж</th>
            <th>Площадь</th>
            <th>Цена</th>
        </thead>
        <tbody>
            <tr v-for="room in rooms" @click="show(room.room_id)">
                <td>{{ room.room_id }}</td>
                <td>{{ room.name }}</td>
                <td>{{ room.count_room }}</td>
                <td>{{ room.max_capacity }}</td>
                <td>{{ room.conditioner }}</td>
                <td>{{ room.tv }}</td>
                <td>{{ room.smoke }}</td>
                <td>{{ room.balcony }}</td>
                <td>{{ room.floor }}</td>
                <td>{{ room.square }} м²</td>
                <td>{{ room.price }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import { router } from '@inertiajs/vue3';

    export default {
        props: {
            rooms: Array,
        },
        methods: {
            show(roomId) {
                router.get(`/rooms/${roomId}`);
            },
        }
    };
</script>

<style>
table {
    border-spacing: 0px;
}

tr>td {
    cursor: pointer;
    padding: 4px 48px;
    text-align: center;
}

tr:hover {
    background-color: gray;
}
</style>