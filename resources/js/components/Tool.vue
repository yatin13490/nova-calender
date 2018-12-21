<template>
    <div class="">
        <full-calendar
            :events="events"
            :config="config"
            @view-render="viewRender"
            @event-selected="evnetSelected"
        >
        </full-calendar>
        <day-modal :event="selectedEvnet" @close="hideModal" ref="popup_modal"></day-modal>
    </div>
</template>

<script>
import dayModal from "../components/Popup.vue"

export default {
    components: {
        dayModal
    },
    mounted() {
        axios.get('nova-vendor/full-calendar/calendar').then(response => {
            this.events = response.data
            if(response.data) {
                this.countEvents();
            }
        });
    },
    data() {
        return {
            showModal: false,
            dayWiseTotalEvent: {},
            events: [],
            selectedEvnet: {},
            config: {
                defaultView: "month",
                header:{
                    right:""
                }
            }
        }
    },
    methods: {
        countEvents() {
            var vm = this;
            vm.events.forEach((event) => {
                var date = event.start;
                if(this.dayWiseTotalEvent[date] == null){
                    this.dayWiseTotalEvent[date] = 0;
                }
                this.dayWiseTotalEvent[date] +=1; 
            });
            this.setDayColor();
        },
        setDayColor() {
            var dayWiseTotalEvent = this.dayWiseTotalEvent;
            var Vm = this;
            for (var key in dayWiseTotalEvent) {
                if (dayWiseTotalEvent.hasOwnProperty(key)) {
                    var val = dayWiseTotalEvent[key];
                    var class_name = Vm.getColorClass(val);
                    var day_cell = document.querySelector(`td.fc-widget-content[data-date='${key}']`);
                    if(day_cell != null){
                        day_cell.className += ` ${class_name}`;
                    }
                }
            }
        },
        getColorClass(count) {
            var color_class = '';
            if(count > 1){
                color_class = 'day-red';
            }else if( count == 1){
                color_class = 'day-yellow';
            }
            return color_class;
        },
        viewRender(view, element){
            this.setDayColor();
        },
        evnetSelected(event, jsEvent, view) {
            this.selectedEvnet = event;
            this.$refs.popup_modal.show();
        },
        hideModal() {
            this.$refs.popup_modal.hide();
        }
    }
}
</script>

<style>
td.fc-day.fc-widget-content:not(.fc-other-month):not(.fc-today) {
    background: white;
}
td.fc-day.fc-widget-content.fc-today {
    background: var(--primary);
}

td.fc-widget-content.day-red {
    background: #ffcccc !important;
    border-top-color: #ff1a1a !important;
}
td.fc-widget-content.day-yellow {
    background: #ffebcc !important;
    border-top-color: #ff9900 !important;
}

</style>
