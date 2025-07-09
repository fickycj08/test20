/**
 * Import function triggers from their respective submodules:
 *
 * const {onCall} = require("firebase-functions/v2/https");
 * const {onDocumentWritten} = require("firebase-functions/v2/firestore");
 *
 * See a full list of supported triggers at https://firebase.google.com/docs/functions
 */
// Create and deploy your first functions
// https://firebase.google.com/docs/functions/get-started

// exports.helloWorld = onRequest((request, response) => {
//   logger.info("Hello logs!", {structuredData: true});
//   response.send("Hello from Firebase!");
// });
const functions = require("firebase-functions");
const admin = require("firebase-admin");
const fetch = require("node-fetch"); // pastikan sudah install

admin.initializeApp();

exports.syncToLaravel = functions.firestore
    .document("users/{userId}")
    .onCreate(async (snap, context) => {
      const data = snap.data();

      try {
        await fetch("https://laravel-kamu.com/api/sync-data", {
          method: "POST",
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify({
            id: context.params.userId,
            name: data.name,
            email: data.email, // tambahkan sesuai data Firestore
          }),
        });

        console.log("Data dikirim ke Laravel");
      } catch (error) {
        console.error("Gagal kirim ke Laravel:", error);
      }
    });
