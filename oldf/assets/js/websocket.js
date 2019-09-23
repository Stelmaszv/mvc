class web {
    constructor(Settings) {
        this.com  = new WebSocket('ws://localhost:8080');
        this.onopen();
        this.onsubmit();
        this.onmessage();
    }
}
