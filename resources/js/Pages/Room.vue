<template>
    <h1>Номер - {{ room.room_id }}</h1>
    
    <div>
        <p>Категория - {{ room.name }}</p>
        <p>Кол-во комнат - {{ room.count_room }}</p>
        <p>Кол-во мест - {{ room.max_capacity }}</p>
        <p>Этаж - {{ room.floor }}</p>
        <p>Площадь - {{ room.square }}</p>
        <p>Кондиционер - 
            <span v-if="room.conditioner == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>Телевизор - 
            <span v-if="room.tv == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>Для курящих - 
            <span v-if="room.smoke == 1">Да</span>
            <span v-else>Нет</span>
        </p>
        <p>Балкон - 
            <span v-if="room.balcony == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>Цена за ночь - {{ room.price }}</p>
    </div>

    <div>
        <!-- Календарь с пометками о занятых датах -->
        <div class="calendar">
            <div class="header">
                <button @click="previousMonth">&lt;</button>
                <h2>{{ getMonthName(month) }} {{ year }}</h2>
                <button @click="nextMonth">&gt;</button>
            </div>
            <div class="days">
                <div v-for="day in days" :key="day" class="day">
                    {{ day }}
                </div>
            </div>
            <div class="weeks">
                <div v-for="week in weeks" :key="week" class="week">
                    <div v-for="date in week" :key="date" class="date" :class="{ booked: isBooked(date) }">
                        {{ date }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            room: Array,
            bookingDates: Array,
        },
        data() {
            return {
                year: new Date().getFullYear(),
                month: new Date().getMonth() + 1,
                days: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
            };
        },
        computed: {
            weeks() {
                const firstDayOfMonth = new Date(this.year, this.month - 1, 1);
                const lastDayOfMonth = new Date(this.year, this.month, 0);
                const weeks = [];

                let week = [];
                let currentDate = new Date(firstDayOfMonth);

                for (let i = 1; i < currentDate.getDay(); i++) {
                    week.push(null);
                }

                while (currentDate <= lastDayOfMonth) {
                    week.push(currentDate.getDate());

                    if (currentDate.getDay() === 0) {
                        weeks.push(week);
                        week = [];
                    }

                    currentDate.setDate(currentDate.getDate() + 1);
                }

                for (let i = week.length; i < 7; i++) {
                    week.push(null);
                }

                if (week.length > 0) {
                    weeks.push(week);
                }

                return weeks;
            },
        },
        methods: {
            previousMonth() {
                if (this.month === 1) {
                    this.month = 12;
                    this.year--;
                } else {
                    this.month--;
                }
            },
            nextMonth() {
                if (this.month === 12) {
                    this.month = 1;
                    this.year++;
                } else {
                    this.month++;
                }
            },
            isBooked(date) {
            const formattedDate = new Date(this.year, this.month - 1, date);

            if (formattedDate.getMonth() !== this.month - 1) {
                return false;
            }

            return this.bookingDates.some(booking => {
                const dateIn = new Date(booking.date_in.year, booking.date_in.month - 1, booking.date_in.day);
                const dateOut = new Date(booking.date_out.year, booking.date_out.month - 1, booking.date_out.day);
                return formattedDate >= dateIn && formattedDate <= dateOut;
            });
        },
            getMonthName(month) {
                const months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
                return months[month - 1];
            },
        },
    };
</script>

<style>
.calendar {
    display: inline-block;
    border: 1px solid #ccc;
    margin-top: 20px;
    width: 300px;
}

.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    background-color: #f0f0f0;
}

.days {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    background-color: #e0e0e0;
}

.weeks {
    display: flex;
    flex-direction: column;
    padding: 10px;
}

.week {
    display: flex;
    justify-content: space-between;
}

.date {
    width: calc(100% / 7);
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc;
}

.booked {
    background-color: #ffcccc;
}
</style>