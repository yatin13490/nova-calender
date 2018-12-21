import FullCalendar from 'vue-full-calendar'
import 'fullcalendar/dist/fullcalendar.css'

Nova.booting((Vue, router) => {
    Vue.use(FullCalendar)
    router.addRoutes([
        {
            name: 'calendar',
            path: '/calendar',
            component: require('./components/Tool'),
        },
    ])
})
