<template>
    <h1>Номер - {{ room.room_id }}</h1>

    <div>
        <p>Категория - {{ room.name }}</p>
        <p>Кол-во комнат - {{ room.count_room }}</p>
        <p>Кол-во мест - {{ room.max_capacity }}</p>
        <p>Этаж - {{ room.floor }}</p>
        <p>Площадь - {{ room.square }}</p>
        <p>
            Кондиционер -
            <span v-if="room.conditioner == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>
            Телевизор -
            <span v-if="room.tv == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>
            Для курящих -
            <span v-if="room.smoke == 1">Да</span>
            <span v-else>Нет</span>
        </p>
        <p>
            Балкон -
            <span v-if="room.balcony == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>Цена за ночь - {{ room.price }}</p>
    </div>
    <div class="calendar">
        <div class="header">
            <div class="header__info">
                <button @click="previousMonth">&lt;</button>
                <h2>{{ getMonthName(month) }} {{ year }}</h2>
                <button @click="nextMonth">&gt;</button>
            </div>
            <div class="selectors">
                <select v-model="month" @change="updateCalendar">
                    <option value="1">Январь</option>
                    <option value="2">Февраль</option>
                    <option value="3">Март</option>
                    <option value="4">Апрель</option>
                    <option value="5">Май</option>
                    <option value="6">Июнь</option>
                    <option value="7">Июль</option>
                    <option value="8">Август</option>
                    <option value="9">Сентябрь</option>
                    <option value="10">Октябрь</option>
                    <option value="11">Ноябрь</option>
                    <option value="12">Декабрь</option>
                </select>
                <select v-model="year" @change="updateCalendar">
                    <option v-for="year in years" :value="year">
                        {{ year }}
                    </option>
                </select>
            </div>
        </div>
        <div class="days">
            <div v-for="day in days" :key="day" class="day">
                {{ day }}
            </div>
        </div>
        <div class="weeks">
            <div v-for="week in weeks" :key="week" class="week">
                <div
                    v-for="date in week"
                    :key="date"
                    class="date"
                    :class="{ booked: isBooked(date) }"
                >
                    {{ date }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        room: Object,
        bookingDates: Array,
    },
    data() {
        return {
            year: new Date().getFullYear(),
            month: new Date().getMonth() + 1,
            days: ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"],
        };
    },
    computed: {
        weeks() {
            const firstDayOfMonth = new Date(this.year, this.month - 1, 1);
            const lastDayOfMonth = new Date(this.year, this.month, 0);
            const weeks = [];

            let currentWeek = [];
            let currentDate = new Date(firstDayOfMonth);

            for (let i = 1; i < currentDate.getDay(); i++) {
                currentWeek.push(null);
            }

            while (currentDate <= lastDayOfMonth) {
                currentWeek.push(currentDate.getDate());

                if (currentDate.getDay() === 0) {
                    weeks.push(currentWeek);
                    currentWeek = [];
                }

                currentDate.setDate(currentDate.getDate() + 1);
            }

            for (let i = currentWeek.length; i < 7; i++) {
                currentWeek.push(null);
            }

            if (lastDayOfMonth.getDay() !== 0) {
                weeks.push(currentWeek);
            }

            return weeks;
        },
        years() {
            const currentYear = new Date().getFullYear();
            return [currentYear, currentYear + 1, currentYear + 2];
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

            return this.bookingDates.some((booking) => {
                const dateIn = new Date(
                    booking.date_in.year,
                    booking.date_in.month - 1,
                    booking.date_in.day
                );
                const dateOut = new Date(
                    booking.date_out.year,
                    booking.date_out.month - 1,
                    booking.date_out.day
                );
                return formattedDate >= dateIn && formattedDate <= dateOut;
            });
        },
        getMonthName(month) {
            const months = [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь",
            ];
            return months[month - 1];
        },
    },
};
</script>

<style scoped>
.calendar {
    display: inline-block;
    border: 1px solid #ccc;
    margin-top: 20px;
    width: 300px;
}

.header {
    padding: 10px;
    background-color: #f0f0f0;
}

.header__info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header__info > button {
    width: 30px;
    height: 30px;
}

.selectors {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
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
