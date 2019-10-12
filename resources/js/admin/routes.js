import Welcome from './../admin/components/Welcome'
import LandingPageSetup from './../admin/pages/landing-page/LandingPageSetup'
import AboutPageSetup from './../admin/pages/about-us/AboutUsPageSetup'
import OurPeoplePageSetup from './../admin/pages/our-people/OurPeoplePageSetup'
import OurKnowledgePageSetup from './../admin/pages/our-knowledge/OurKnowledgePageSetup'
import NewsPageSetup from './../admin/pages/news/NewsPageSetup'
import EventsPageSetup from './../admin/pages/events/EventsPageSetup'
import ContactPageSetup from './../admin/pages/contact/ContactPageSetup'

export const routes = [
    {
        path: '/',
        component: Welcome
    },
    {
        path: '/landing-page-setup',
        component: LandingPageSetup
    },
    {
        path: '/about-us-setup',
        component: AboutPageSetup
    },
    {
        path: '/our-people-setup',
        component: OurPeoplePageSetup
    },
    {
        path: '/our-knowledge-setup',
        component: OurKnowledgePageSetup
    },
    {
        path: '/news-setup',
        component: NewsPageSetup
    },
    {
        path: '/events-setup',
        component: EventsPageSetup
    },
    {
        path: '/contact-us-setup',
        component: ContactPageSetup
    },
]
