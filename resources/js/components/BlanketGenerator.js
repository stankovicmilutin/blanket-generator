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
            "selectedTemplate":  props.blanket.template_id || '',
            "template": props.blanket.template || {},
            "elements": this.parseElements(props.blanket),
            "date": props.blanket.date ? new Date(props.blanket.date) : '',
            "header": {
                "university": "Univerzitet u Nišu",
                "college": "Elektronski fakultet",
                "department": props.course.department,
            },
            "footer": {
                "signature": "Predmetni nastavnik"
            },
            "title": props.blanket.template ? props.blanket.template.name : props.course.name,
            "examinationPeriod": props.blanket.examination_period || ''
        };

        // console.log(props);
    }

    parseElements(blanket) {
        if (!blanket.template) {
            return [];
        }

        let elements = blanket.template.elements;
        let tasks = [...blanket.tasks];

        return elements.map(e => {
            if (e.type === 'task' && tasks.length) {
                e.task = tasks.shift();
                e.taskIndex = e.domain.tasks.findIndex(t => t.id === e.task.id);
            }

            return e;
        });
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
                        title: res.data.data.name,
                        elements: res.data.data.elements.map(e => {
                            if (e.type === 'task') {
                                let picker = this.pickTask(e);
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
                task: element.domain.tasks[oldTaskIndex],
                index: oldTaskIndex,
                hideIcon: true
            }
        }

        if (tasks.length === 0) {
            return {
                task: {
                    body: 'Not enough tasks for set domain'
                },
                index: -1
            };
        }

        let index = this.getRandomIndex(tasks.length);

        if (index === oldTaskIndex) {
            return this.pickTask(element, oldTaskIndex);
        }

        return {
            task: tasks[index],
            index: index
        };
    }

    refreshTask(templateElement, elementIndex) {
        let pickedTask = this.pickTask(templateElement, templateElement.taskIndex);
        let elements = this.state.elements;
        elements[elementIndex].task = pickedTask.task;
        elements[elementIndex].taskIndex = pickedTask.index;
        elements[elementIndex].hideIcon = pickedTask.hideIcon;

        this.setState({elements: elements});
    }

    getRandomIndex = (maxIndex) => Math.floor(Math.random() * maxIndex);

    submitForm() {
        let requestData = {
            "template_id": this.state.template.id,
            "date": this.state.date,
            "examination_period": this.state.examinationPeriod,
            "elements" : this.state.template.elements.map((e, i) => {

                let element = {
                    id: e.id,
                    type: e.type,
                    text: e.text,
                };

                if (e.type === 'task' && e.taskIndex !== -1) {
                    element.task = e.task;
                }

                return element;
            })
        };

        if (this.props.blanket.id) {
            axios.put(`/blankets/${this.props.blanket.id}`, requestData)
            .then(() => window.location.href = '/blankets');
        } else {
            axios.post(`/blankets`, requestData)
            .then(() => window.location.href = '/blankets');
        }
    }

    render() {
        let taskCounter = 1;
        return (
            <div className="container">
                <div className="row mb-2">
                    <div className="col-4">
                        <label className="">Template</label>
                        <select className="form-control" value={this.state.selectedTemplate} onChange={(event) => this.handleTemplateChange(event.target.value)}>
                            <option value='' disabled={true}>Chose template</option>
                            {this.props.course.templates.map((template, index) =>
                                <option key={index} value={template.id}>{template.name}</option>
                            )}
                        </select>
                    </div>
                    <div className="col-4">
                        <label className="text-center">Examination Period</label>
                        <select className="form-control"
                                value={this.state.examinationPeriod}
                                onChange={(event) => this.setState({examinationPeriod: event.target.value})}>
                            <option value='' disabled={true}>Chose Period</option>
                            <option value="Januar">Januar</option>
                            <option value="April">April</option>
                            <option value="Jun">Jun</option>
                            <option value="Septembar">Septembar</option>
                            <option value="Oktobar">Oktobar</option>
                            <option value="Oktobar II">Oktobar II</option>
                            <option value="Decembar">Decembar</option>
                        </select>
                    </div>
                    <div className="col-4">
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
                                                    <div className="col-2 text-right">{taskCounter++}. {templateElement.task ? templateElement.task.id : '/'}</div>
                                                    <div className="col-9" dangerouslySetInnerHTML={{__html: templateElement.task ? templateElement.task.body : '/'}}/>
                                                    { ! templateElement.hideIcon &&
                                                        <div className="col-1 text-danger" onClick={() => this.refreshTask(templateElement, index)}>
                                                            <i className="fa fa-refresh"/>
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
        blanket={JSON.parse(props.blanket)}
    />, element);
}
