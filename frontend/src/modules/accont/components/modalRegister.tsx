import React from 'react';
import { connect } from "react-redux";
import { bindActionCreators, Dispatch } from "redux";
import { ApplicationState } from "../../../store";
import { Account } from "../../../store/ducks/account/types";
import * as AccountActions from "../../../store/ducks/account/action";

interface State {
    name: string,
    sale: number
}

interface StateProps {
    isErrorRegister: string,
    isLoadingRegister: boolean
}

interface DispatchProps {
    accountRegister(params: Account): void
}

interface OwnProps { }

type Props = StateProps & DispatchProps & OwnProps;

class ModalRegister extends React.PureComponent<Props, State> {

    constructor(props: Props) {
        super(props);
        this.state = {
            name: "",
            sale: 0
        }
    }

    render(): React.ReactNode {
        const { isErrorRegister, isLoadingRegister } = this.props;
        return(
            <div className="modal fade" id="modal-register-account" aria-hidden="true">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title">Nova conta</h4>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <form className="mb-3">
                                <div className="form-group">
                                    <input
                                        id="name"
                                        type="text"
                                        placeholder="Nome da conta"
                                        onChange={e => this.setState({name: e.target.value})}
                                        className={`form-control ${isErrorRegister === "name" && 'is-invalid'}`}
                                    />
                                </div>
                                <div className="form-group">
                                    <input
                                        id="sale"
                                        type="text"
                                        placeholder="Saldo atual"
                                        onChange={e => this.setState({sale: Number(e.target.value)})}
                                        className={`form-control ${isErrorRegister === "sale" && 'is-invalid'}`}
                                    />
                                </div>
                            </form>
                        </div>
                        <div className="modal-footer justify-content-between">
                            <button type="button" className="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" className="btn btn-primary" data-dismiss="modal" onClick={() => this.props.accountRegister(this.state)}>
                                { isLoadingRegister ? "Salvando..." : "Salvar" }
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }

}

const mapStateToProps = (state: ApplicationState) => ({
    isErrorRegister: state.account.isErrorRegister,
    isLoadingRegister: state.account.isLoadingRegister,
});
const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators(AccountActions, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(ModalRegister);