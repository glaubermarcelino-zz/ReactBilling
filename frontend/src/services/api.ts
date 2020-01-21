import qs from 'qs';
import axios from 'axios';
import { Constants } from '../constants';
import { Request } from '../factory/request/request';

export class Api {

    static run(request: Request) {
        let content: object = {
            url: `${Constants.API_URL}${request.url}`,
            method: request.method,
            headers: request.headers
        };
        content = request.method === "GET" ?
            { ...content, params: request.params }
        :
            { ...content, data: qs.stringify(request.params) };
        return axios(content);
    }

}
