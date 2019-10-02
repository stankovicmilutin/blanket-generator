import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import Swal from 'sweetalert2';

class BlanketGenerator extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            "course": props.course,
            "selectedTemplate": '',
            "template": {},
            "elements": [],
            "date": '',
            "header": {
                "university": "Univerzitet u Nišu",
                "college": "Elektronski fakultet",
                "department": props.course.department,
            },
            "footer": {
                "signature": "Predmetni nastavnik"
            },
            "title": props.template.name || props.course.name,
        };

        console.log(props);
    }

    handleTemplateChange(templateId) {
        this.setState({
            selectedTemplate: templateId,
            isLoading: true
        }, () => {
            axios.get('/templates/' + templateId + '/elements')
                .finally(() => this.setState({isLoading: false}))
                .then((res) => {
                    this.setState({
                        template: res.data.data,
                        elements: res.data.data.elements.map(e => {
                            if (e.type === 'task') {
                                let picker = this.pickTask(e);
                                console.log(picker);
                                e.task = picker.task;
                                e.taskIndex = picker.index;
                            }
                            return e;
                        })
                    });
                }, err => console.log(err));
        });
    }

    pickTask(element, oldTaskIndex = null) {
        let tasks = element.domain.tasks.filter(t => t.type === element.domain_type);

        // Re-picking
        if (oldTaskIndex != null && tasks.length < 2) {
            Swal.fire({
                type: 'error',
                title: 'Not enough tasks',
                text: 'There is only one task for this domain and domain type!',
            });
            return {
                task: tasks[oldTaskIndex].body,
                index: -1
            }
        }

        if (tasks.length === 0) {
            return {
                task: 'Not enough tasks for set domain',
                index: -1
            };
        }

        let index = this.getRandomIndex(tasks.length);

        if (index === oldTaskIndex) {
            return this.pickTask(element, oldTaskIndex);
        }

        return {
            task: tasks[index].body,
            index: index
        };
    }

    refreshTask(templateElement, taskIndex, elementIndex) {
        let pickedTask = this.pickTask(templateElement, taskIndex);
        let elements = this.state.elements;
        elements[elementIndex].task = pickedTask.task;
        elements[elementIndex].taskIndex = pickedTask.index;

        this.setState({elements: elements});
    }

    getRandomIndex = (maxIndex) => Math.floor(Math.random() * maxIndex);

    submitForm() {
        axios.post(`/templates`, this.state);
    }

    render() {
        let taskCounter = 1;
        return (
            <div className="container">
                <div className="row mb-2">
                    <div className="col-6">
                        <label className="">Template</label>
                        <select className="form-control" value={this.state.selectedTemplate} onChange={(event) => this.handleTemplateChange(event.target.value)}>
                            <option value='' disabled={true}>Chose template</option>
                            {this.props.course.templates.map((template, index) =>
                                <option key={index} value={template.id}>{template.name}</option>
                            )}
                        </select>
                    </div>
                    <div className="col-6 text-right">
                        <label className="d-block">Date</label>
                        <DatePicker
                            className="form-control"
                            dateFormat="dd.MM.yyyy."
                            selected={this.state.date}
                            onChange={(d) => this.setState({date: d})}
                        />
                    </div>
                </div>

                <h2 className='text-center py-3'>Preview</h2>

                <div className="blanket">
                    <div className="row justify-content-center">
                        <div className="col-md-12">
                            <div className="card">
                                <div className="card-header">
                                    <div className="pull-left">
                                        <div>{this.state.header.university}</div>
                                        <div>{this.state.header.college}</div>
                                        <div>{this.state.header.department.name}</div>
                                    </div>
                                    <div className="pull-right">{
                                        this.state.date !== ''
                                            ? [this.state.date.getDate(), this.state.date.getMonth() + 1, this.state.date.getFullYear()].join('. ') + "."
                                            : '__.__.____'
                                    }</div>
                                </div>
                                <hr/>
                                <div className="card-body">
                                    <div className="row">
                                        <div className="col-12">
                                            <h4 className="text-center">{this.state.title}</h4>
                                        </div>
                                    </div>

                                    {this.state.elements.map((templateElement, index) => {
                                        if (templateElement.type === 'separator') {
                                            return <hr key={index}/>;

                                        }

                                        if (templateElement.type === 'heading') {
                                            taskCounter = 1;
                                            return <h3 key={index}>{templateElement.text}</h3>
                                        }

                                        if (templateElement.type === 'task') {
                                            return (
                                                <div className="row pt-1" key={index}>
                                                    <div className="col-1 text-right">{taskCounter++}.</div>
                                                    <div className="col-10" dangerouslySetInnerHTML={{__html: templateElement.task}}/>
                                                    {templateElement.taskIndex !== -1 &&
                                                        <div className="col-1 text-danger" onClick={() => {
                                                            this.refreshTask(templateElement, templateElement.taskIndex, index)
                                                        }}><i className="fa fa-refresh"/>
                                                        </div>
                                                    }
                                                </div>
                                            )
                                        }
                                    })}
                                    <hr/>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div className="">
                    <div className="card-footer text-center">
                        <button className="btn btn-primary" onClick={() => this.submitForm()}>Save</button>
                    </div>
                </div>
            </div>
        );
    }

}

if (document.getElementById('blanketGenerator')) {
    let element = document.getElementById('blanketGenerator');
    let props = element.dataset;
    ReactDOM.render(<BlanketGenerator
        course={JSON.parse(props.course)}
        template={JSON.parse(props.blanket)}
    />, element);
}
