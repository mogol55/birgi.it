const statusEl = document.getElementById('status');
const notifyBtn = document.getElementById('notifyBtn');

async function registerServiceWorker() {
  if (!('serviceWorker' in navigator)) {
    statusEl.textContent = 'Service Worker is not supported in this browser.';
    return;
  }

  try {
    const registration = await navigator.serviceWorker.register('sw.js');
    statusEl.textContent = `Service Worker registered: ${registration.scope}`;
  } catch (error) {
    statusEl.textContent = `Service Worker registration failed: ${error.message}`;
  }
}

async function sendTestNotification() {
  if (!('Notification' in window)) {
    alert('Notifications are not supported in this browser.');
    return;
  }

  let permission = Notification.permission;
  if (permission === 'default') {
    permission = await Notification.requestPermission();
  }

  if (permission !== 'granted') {
    alert('Notification permission not granted.');
    return;
  }

  const registration = await navigator.serviceWorker.ready;
  registration.showNotification('Birgi App', {
    body: 'This is a test notification from your PWA.',
    icon: 'icon-192.png',
    badge: 'icon-192.png',
  });
}

notifyBtn.addEventListener('click', sendTestNotification);
registerServiceWorker();
