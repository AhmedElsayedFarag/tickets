importScripts('https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.4.3/firebase-messaging.js');


const firebaseConfig = {
    apiKey: "AIzaSyBW9W5JuV0CDgIqyDCnr_bVvwlgBKRG2Tc",
    authDomain: "tickets-cd778.firebaseapp.com",
    projectId: "tickets-cd778",
    storageBucket: "tickets-cd778.appspot.com",
    messagingSenderId: "574878109709",
    appId: "1:574878109709:web:2d5440857c5c7256fac544",
    measurementId: "G-V557Y1LN75",
};


firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();
// messaging.setBackgroundMessageHandler(function (payload) {
//     // console.log(payload);
//     // console.log(payload.notification.data.gcm.notification.url);
//     console.log('ahmed');
//     const notification=JSON.parse(payload);
// ;
//     const notificationOption={
//         body:notification.body,
//         icon:notification.icon,
//     };
//
//     return self.registration.showNotification(payload.notification.title,notificationOption);
// });
// self.registration.addEventListener('notificationclick',function (event){
//     // event.notification.close();
//     // Open the url you set on notification.data
//     clients.openWindow('https://www.google.com/');
//     clients.openWindow('https://www.google.com/');
//     // clients.openWindow(event.notification.data.url)
// });
