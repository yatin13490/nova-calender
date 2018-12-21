<template>
    <modal v-if="showModal" >
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 460px;">
            <div class="p-8">
                <h2 class="mb-6 text-90 font-normal text-xl">{{ event.enquiry.name }}</h2>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">ID</h4></div> 
                    <div class="w-3/4 py-4"><p class="text-90">{{ event.id }}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">Date</h4></div> 
                    <div class="w-3/4 py-4"><p class="text-90">{{ $options.filters.getDate(event.start) }}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">No of Guest</h4></div> 
                    <div class="w-3/4 py-4"><p class="text-90">{{ event.guest }}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">Vanue</h4></div> 
                    <div class="w-3/4 py-4"><p class="text-90">{{ event.venue.name }}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">Time</h4></div> 
                    <div class="w-3/4 py-4"><p class="text-90">{{ $options.filters.getTime(event.time) }}</p></div>
                </div>
                <div class="flex border-b border-40">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">Event</h4></div> 
                    <div class="w-3/4 py-4"><p class="text-90">{{ event.event_type.name }}</p></div>
                </div>
            </div>
            <div class="bg-30 px-6 py-3 flex">
                <div class="ml-auto"><button type="button" class="btn text-80 font-normal h-9 px-3 mr-3 btn-link" @click="$emit('close')" >Cancel</button>
                <a :href="'/resources/enquiry-events/' + event.id" target="_blank" class="btn btn-default btn-danger" @click="$emit('close')">View Event</a></div>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    props: ['event'],
    mounted() {
    },
    data() {
        return {
            showModal: false
        }
    },
    methods: {
        show() {
            this.showModal = true;
        },
        hide() {
            this.showModal = false;
        },
        close() {
            this.showModal = false;
        }

    },
    filters: {
		getTime: function (time) {
			let result = moment( time, "HH:mm:ss" ).format('hh:mm A');
			return result;
        },
        getDate: function (date) {
            return date.format('DD-MM-YYYY');
        }
    },
    computed: {
    },
}
</script>

<style>

</style>
