import React, {Component} from 'react'
import ReactDOM from 'react-dom'

import ScrollableGallery from './components/ScrollableGallery'

class App extends Component {
    constructor(props) {
        super(props);

        const root = document.getElementById('gallery-target')
        this.slides = JSON.parse(root.dataset.feed)
    }


    render() {
        return (
            <ScrollableGallery
                style={ { width: '100vw', height: '100vh' } }
                slides={[]}
                projects={this.slides}
            />
        )
    }
}

ReactDOM.render(
    React.createElement(App, {}, null),
    document.getElementById('gallery-target')
);
