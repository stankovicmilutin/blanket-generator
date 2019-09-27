import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

class TemplateGenerator extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            "course": props.course,
            "template_id": props.template ? props.template.id : null,
            "header": {
                "university": "Univerzitet u Nišu",
                "college": "Elektronski fakultet",
                "department": props.course.department,
            },
            "footer": {
                "signature": "Predmetni nastavnik"
            },
            "title": props.template.name || props.course.name,
            "template": this.parseTemplate(props.template),
            addElementMode: false,
        };
    }

    parseTemplate(template) {
        let elements = [];

        template.elements.map(e => elements.push(
            {
                type: e.type,
                domain: e.domain_id,
                domain_type: e.domain_type,
                text: e.text
            }
        ));

        return elements;
    }

    addElement(type) {
        this.setState({
            template: [...this.state.template, {
                type: type,
                text: type === 'heading' ? 'Heading' : '',
                editMode: true,
                domain: this.props.course.domains.length ? this.props.course.domains[0].id : null,
                domain_type: 'practice'
             }],
            // addElementMode: false
        })
    }

    setDomain(event, index) {
        let elements = this.state.template;
        elements[index].domain = event.target.value;
        this.setState({template: elements});
    }

    setDomainType(event, index) {
        let elements = this.state.template;
        elements[index].domain_type = event.target.value;
        this.setState({template: elements});
    }

    showDomainName(domainId) {
        let domain = this.props.course.domains.find((e) => e.id == domainId);
        return domain ? domain.name : '';
    }

    toggleEditMode(index) {
        let elements = this.state.template;
        elements[index].editMode = !elements[index].editMode;
        this.setState({template: elements});
    }

    removeElement(index) {
        this.setState({template: this.state.template.filter((e, i) => i !== index)});
    }

    updateHeading(text, index) {
        let elements = this.state.template;
        elements[index].text = text;
        this.setState({template: elements});
    }

    submitForm() {
        axios.post(`/templates`, this.state);
    }

    render() {
        let taskCounter = 1;
        return (
            <div className="container blanket">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">
                                <div className="pull-left">
                                    <div>{this.state.header.university}</div>
                                    <div>{this.state.header.college}</div>
                                    <div>{this.state.header.department.name}</div>
                                </div>
                                <div className="pull-right">__.__.____</div>
                            </div>
                            <hr/>
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-12">
                                        <h4 className="text-center">
                                            <input type="text"
                                                   className="p-2"
                                                   style={{border: "none", fontSize: '1.35rem', textDecoration: 'underline dashed'}}
                                                   size={this.state.title.length * 1.15 || 1}
                                                   onChange={(e) => this.setState({title: e.target.value})}
                                                   value={this.state.title}/>
                                        </h4>
                                    </div>
                                </div>
                                {this.state.template.map((templateElement, index) => {
                                    if (templateElement.type == 'separator') {
                                        return <React.Fragment key={index}>
                                            <span className="text-danger pull-right pb-1" style={{marginTop: -10}} onClick={() => this.removeElement(index)}><i className="fa fa-times"/></span>
                                            <hr/>
                                        </React.Fragment>

                                    }

                                    if (templateElement.type == 'heading') {
                                        taskCounter = 1;
                                        return <div key={index}>
                                            <input type="text"
                                                   className="p-2"
                                                   style={{border: "none", fontSize: '1.35rem'}}
                                                   size={templateElement.text.length * 1.15 || 1}
                                                   key={index}
                                                   onChange={(e) => this.updateHeading(e.target.value, index)}
                                                   autoFocus={(index + 1) === this.state.template.length}
                                                   value={templateElement.text}/>
                                            <span className="text-danger pl-2" onClick={() => this.removeElement(index)}><i className="fa fa-times"/></span>
                                        </div>
                                    }

                                    if (templateElement.type == 'task') {
                                        return (
                                            <div className="row pt-1" key={index}>
                                                <div className="col-1 text-right pt-2">{taskCounter++}.</div>

                                                {templateElement.editMode &&
                                                <React.Fragment>
                                                    <div className="col-10">
                                                        <select className="form-control d-inline w-50" value={templateElement.domain} onChange={(event) => this.setDomain(event, index)}>
                                                            {this.props.course.domains.map((domain, index) =>
                                                                <option key={index} value={domain.id}>{domain.name}</option>
                                                            )}
                                                        </select>
                                                        <select className="form-control d-inline w-25 mx-2" value={templateElement.domain_type} onChange={(event) => this.setDomainType(event, index)}>
                                                            <option value="practice">Practice</option>
                                                            <option value="theory">Theory</option>
                                                        </select>
                                                        <div className="d-inline-block pt-1 pl-2">
                                                            <span className="text-success" onClick={() => this.toggleEditMode(index)}><i className="fa fa-check"/></span>
                                                            <span className="text-danger" onClick={() => this.removeElement(index)}><i className="fa fa-times"/></span>
                                                        </div>
                                                    </div>
                                                </React.Fragment>
                                                }
                                                {!templateElement.editMode &&
                                                <React.Fragment>
                                                    <div className="col-10">
                                                        <span>{this.showDomainName(templateElement.domain) + ` (${templateElement.domain_type})`}</span>

                                                        <div className="d-inline-block pt-1">
                                                            <span className="text-warning" onClick={() => this.toggleEditMode(index)}><i className="fa fa-pencil"/></span>
                                                            <span className="text-danger" onClick={() => this.removeElement(index)}><i className="fa fa-times"/></span>
                                                        </div>
                                                    </div>
                                                </React.Fragment>
                                                }
                                            </div>
                                        )
                                    }
                                })}

                                {!this.state.addElementMode &&
                                <span className="btn btn-outline-primary mt-3" onClick={() => this.setState({addElementMode: true})}>Add element</span>
                                }
                                {this.state.addElementMode &&
                                <div className="mt-3">
                                    <span className="btn btn-outline-primary" onClick={() => this.addElement('task')}>Add Task</span>
                                    <span className="btn btn-outline-primary ml-1 mr-1" onClick={() => this.addElement('heading')}>Add Heading</span>
                                    <span className="btn btn-outline-primary" onClick={() => this.addElement('separator')}>Add Separator</span>
                                </div>
                                }

                                <hr/>

                            </div>
                            <div className="card-footer text-center">
                                <button className="btn btn-primary" onClick={() => this.submitForm()}>Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('templateGenerator')) {
    let element = document.getElementById('templateGenerator');
    let props = element.dataset;
    ReactDOM.render(<TemplateGenerator
        course={JSON.parse(props.course)}
        template={JSON.parse(props.template)}
    />, element);
}
