import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    if (!window.bootstrap) {
        return;
    }

    document.querySelectorAll('.alert-auto-dismiss').forEach((alert) => {
        window.setTimeout(() => {
            const instance = window.bootstrap.Alert.getOrCreateInstance(alert);
            instance.close();
        }, 3200);
    });
});
