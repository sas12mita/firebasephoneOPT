<!DOCTYPE html>
<html>
<head>
    <title>Phone OTP Verification - Firebase v9</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px auto;
            max-width: 400px;
            text-align: center;
        }
        input, button {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            font-size: 16px;
        }
        #success {
            color: green;
            font-weight: bold;
            display: none;
        }
        #recaptcha-container {
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <h2>Verify Your Phone</h2>
    <input type="text" id="phone-number-input" placeholder="Enter phone number e.g. +9779xxxxxxxx" />
    <div id="recaptcha-container"></div>
    <button id="send-otp-btn">Send OTP</button>
    <input type="text" id="otp" placeholder="Enter OTP" />
    <button id="verify-otp-btn">Verify OTP</button>
    <p id="success">Phone verified successfully!</p>

    <!-- Firebase SDKs v9+ -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js";
        import { 
            getAuth, 
            RecaptchaVerifier, 
            signInWithPhoneNumber 
        } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCKx6P0balRFDQxy6fl3NT2GP3IQx_s-ME",
            authDomain: "kaam-sansar.firebaseapp.com",
            projectId: "kaam-sansar",
            storageBucket: "kaam-sansar.firebasestorage.app",
            messagingSenderId: "165516477133",
            appId: "1:165516477133:web:413793338a185743825f84",
            measurementId: "G-YZLN2WB6P9"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        
        let confirmationResult;
        let recaptchaVerifier;

        // Initialize reCAPTCHA verifier
        function initializeRecaptcha() {
            if (recaptchaVerifier) {
                recaptchaVerifier.clear();
            }
            recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
                size: 'normal',
                callback: (response) => {
                    console.log('reCAPTCHA solved', response);
                },
                'expired-callback': () => {
                    console.log('reCAPTCHA expired');
                    initializeRecaptcha();
                }
            }, auth);
            
            return recaptchaVerifier.render();
        }

        // Initialize on page load
        window.addEventListener('load', () => {
            initializeRecaptcha().catch(error => {
                console.error('reCAPTCHA initialization error:', error);
            });
        });

        // Send OTP button click
        document.getElementById('send-otp-btn').addEventListener('click', async () => {
            const phoneNumber = document.getElementById('phone-number-input').value.trim();
            if (!phoneNumber) {
                alert("Please enter a valid phone number in international format.");
                return;
            }

            try {
                await initializeRecaptcha();
                confirmationResult = await signInWithPhoneNumber(auth, phoneNumber, recaptchaVerifier);
                alert("OTP sent to " + phoneNumber);
            } catch (error) {
                console.error("Error sending OTP:", error);
                alert(`Error: ${error.message}`);
                if (recaptchaVerifier) {
                    recaptchaVerifier.clear();
                }
            }
        });

        // Verify OTP button click
        document.getElementById('verify-otp-btn').addEventListener('click', async () => {
            const code = document.getElementById('otp').value.trim();
            if (!code) {
                alert("Please enter the OTP");
                return;
            }

            if (!confirmationResult) {
                alert("Please request OTP first.");
                return;
            }

            try {
                await confirmationResult.confirm(code);
                document.getElementById('success').style.display = 'block';
                alert("Phone verified successfully!");
            } catch (error) {
                console.error("Error verifying OTP:", error);
                alert("Invalid OTP or verification failed");
            }
        });
    </script>
</body>
</html>