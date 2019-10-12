import Welcome from './admin/components/Welcome'
import LandingPageSetup from './admin/components/LandingPageSetup'
import AboutPageSetup from './admin/components/AboutPageSetup'
import OurPeoplePageSetup from './admin/components/OurPeoplePageSetup'
import OurKnowledgePageSetup from './admin/components/OurKnowledgePageSetup'
import NewsPageSetup from './admin/components/NewsPageSetup'
import EventsPageSetup from './admin/components/EventsPageSetup'
import ContactPageSetup from './admin/components/ContactPageSetup'
import ManageLogo from './admin/components/ManageLogo'

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
    {
        path: '/manage/logo',
        component: ManageLogo
    },
]
