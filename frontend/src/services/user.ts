import { Constants } from '../constants';
import {LocalStorage} from "../factory/localStorage";

export class User {

    static setUser(data: object) {
        LocalStorage.setObject(Constants.STORAGE_USER, data);
    }

}