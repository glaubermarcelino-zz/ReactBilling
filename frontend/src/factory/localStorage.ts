export class LocalStorage {

    static set(key: string, value: any): void
    {
        localStorage.setItem(btoa(String(key)), btoa(String(value)));
    }

    static get(key: string): any
    {
        const values = localStorage.getItem(btoa(String(key)));
        return values ? atob(values) : values;
    }

    static setObject(key: string, value: any): void
    {
        localStorage.setItem(btoa(String(key)), btoa(JSON.stringify(value)));
    }

    static getObject(key: string): any
    {
        const values = localStorage.getItem(btoa(String(key)));
        // @ts-ignore
        return JSON.parse(values ? atob(values) : values);
    }

    static removeItem(key: string): void
    {
        localStorage.removeItem(btoa(String(key)));
    }

    static clear(): void
    {
        localStorage.clear();
    }
}