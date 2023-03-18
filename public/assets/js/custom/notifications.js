// importScripts('https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/8.4.3/firebase-messaging.js');
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
const messaging = firebase.messaging();

function IntitalizeFireBaseMessaging() {
    messaging
        .requestPermission()
        .then(function () {
            console.log("Notification Permission");
            return messaging.getToken();
        })
        .then(function (token) {
            console.log("Token : " + token);
            updateDeviceToken(token);
        })
        .catch(function (reason) {
            console.log(reason);
        });
}//end IntitalizeFireBaseMessaging

messaging.onMessage(function (payload) {
    console.log(payload);
    const notificationOption = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };

    if (Notification.permission === "granted") {
        var notification = new Notification(payload.notification.title, notificationOption);

        notification.onclick = function (ev) {
            ev.preventDefault();
            //payload.data['gcm.notification.url']
            // window.open(payload.notification.click_action, '/notifications');
            window.open(payload.data['gcm.notification.url']);
            notification.close();
        }
    }

});
messaging.onTokenRefresh(function () {
    messaging.getToken()
        .then(function (newtoken) {
            console.log("New Token : " + newtoken);
        })
        .catch(function (reason) {
            console.log(reason);
        })
})
IntitalizeFireBaseMessaging();


//     // Import the functions you need from the SDKs you need
//     import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
//     import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-analytics.js";
//     import { getMessaging } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging.js";
//
//     // TODO: Add SDKs for Firebase products that you want to use
//     // https://firebase.google.com/docs/web/setup#available-libraries
//
//     // Your web app's Firebase configuration
//     // For Firebase JS SDK v7.20.0 and later, measurementId is optional
//     const firebaseConfig = {
//     apiKey: "AIzaSyCoKjGEbOl9mBbLKyu2plN8l24JbBIlV-8",
//     authDomain: "ticketing-26ab2.firebaseapp.com",
//     projectId: "ticketing-26ab2",
//     storageBucket: "ticketing-26ab2.appspot.com",
//     messagingSenderId: "895661047714",
//     appId: "1:895661047714:web:16e301d0a42c374032fcfb",
//     measurementId: "G-1V8K85NMKK"
// };
//
//     // Initialize Firebase
//     const app = initializeApp(firebaseConfig);
//     const analytics = getAnalytics(app);
//     // Initialize Firebase Cloud Messaging and get a reference to the service
//     const messaging = getMessaging(app);


// window.OneSignal = window.OneSignal || [];
// OneSignal.push(function () {
//     OneSignal.init({
//         appId: "73215514-fa49-464c-87e1-a43ed41a6edb",
//         // appId: "11743454-b2b1-461e-8361-0198b52abb8f",
//         // safari_web_id: "web.onesignal.auto.45e32f52-047f-48ea-8b6f-5a9d2fcde2db",
//         notifyButton: {
//             enable: false,
//         },
//         // subdomainName: "ticketing-memp",
//         allowLocalhostAsSecureOrigin: true,
//     });
//     OneSignal.showSlidedownPrompt();
//     OneSignal.getUserId(function(userId) {
//         $.ajax({
//             url:'/users/update_device_token',
//             method:'post',
//             data: {
//                 _token:$('input[name="_token"]').val(),
//                 device_token:userId
//             }
//         });
//     });
// });


function updateDeviceToken(token){
    $.ajax({
        url:'/users/update_device_token',
        method:'post',
        data: {
            _token:$('input[name="_token"]').val(),
            device_token:token
        }
    });
}
