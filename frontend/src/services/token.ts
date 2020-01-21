import axios from 'axios';
import { Constants } from "../constants";
import { LocalStorage } from '../factory/localStorage';

interface Data {
    token: string,
    refresh_token: string
}

export class Token {

    static setToken(data: Data) {
        LocalStorage.set(Constants.STORAGE_TOKEN, data.token);
        LocalStorage.set(Constants.STORAGE_REFRESH, data.refresh_token);
        axios.defaults.headers.common['Authorization'] = data.token;
    }

}