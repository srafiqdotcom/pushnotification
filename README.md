# pushnotification
POC/ Demo : Apple Push Notifications and Silent Notifications using p8 File PHP


Proof of Concept: Apple Push Notifications and Silent Notifications using PHP with p8 File

In this Proof of Concept (PoC), I implemented Apple Push Notifications and Silent Notifications using PHP, utilizing the p8 file method for authentication. 
Push notifications are a powerful way to engage users with timely updates, while silent notifications allow for background updates and data synchronization without directly notifying the user.

Key Requirements:

1. p8 file  #generated from apple developer console
2. teamId #found from apple developer console
3. KeyId # from developer console. or name of p8 key file would be like AuthKey_5W9L76ZK4J.p8  .The part after AuthKey_ and before .p8 would be this key id.
4. budleId com.organization.app
5. deviceToken #device token you want to send your notification
   

# Steps:

After preparing the above variables execute the index.php script and notification will be sent. 

# Send Push Notification:

Using the PHP script, send a push notification to the target device.
Handle any response or error codes from APNs.

# Send Silent Notification:

Construct a silent notification payload that triggers background tasks in your app.
Use the PHP script to send the silent notification to the device.
Process the silent notification on the app side.

# Benefits and Learning:

Real-time Engagement: Push notifications provide instant updates to users, enhancing user engagement and interaction with the app.

Background Sync: Silent notifications allow for background data synchronization, ensuring the app's data is up-to-date without disturbing the user.

Security: Utilizing the p8 file method ensures secure communication between your server and APNs.

Skill Development: This PoC enhances your skills in working with server-side scripting (PHP), authentication, API integration, and iOS development.
