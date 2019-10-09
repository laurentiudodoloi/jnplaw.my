import React from 'react'
import ReactDOM from 'react-dom'

import ScrollableGallery from './components/ScrollableGallery'

class App extends React.Component {
    constructor(props) {
        super(props);

        const root = document.getElementById('gallery-target')
        const feed = JSON.parse(root.dataset.feed)
        this.slides = feed.projects
        this.logo = feed.company_logo
    }

    render() {
        return (
            <ScrollableGallery
                style={ { width: '100vw', height: '100vh' } }
                slides={[]}
                projects={this.slides}
                logo={this.logo}
            />
        )
    }
}

ReactDOM.render(
    React.createElement(App, {}, null),
    document.getElementById('gallery-target')
);
