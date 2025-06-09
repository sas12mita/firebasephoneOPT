<!DOCTYPE html>
<html>
<head>
    <title>Phone OTP Verification</title>
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
            box-sizing: border-box;
        }
        #success {
            color: green;
            font-weight: bold;
            display: none;
        }
        #recaptcha-container {
            margin: 15px 0;
        }
        #phone-display {
            font-weight: bold;
            margin: 15px 0;
        }
        .phone-input {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Verify Your Phone</h2>
    <div class="phone-input">
        <input type="tel" id="phone-number" placeholder="Enter phone number with country code" />
    </div>
    <div id="phone-display" style="display: none;">Verifying: <span id="phone-number-display"></span></div>
    <div id="recaptcha-container"></div>
    <button id="send-otp-btn">Send OTP</button>
    <input type="text" id="otp" placeholder="Enter OTP" disabled />
    <button id="verify-otp-btn" disabled>Verify OTP</button>
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
            storageBucket: "kaam-sansar.appspot.com",
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

        // Send OTP button
        document.getElementById('send-otp-btn').addEventListener('click', async () => {
            const phoneNumber = document.getElementById('phone-number').value.trim();
            
            if (!phoneNumber) {
                alert("Please enter a phone number");
                return;
            }

            try {
                await initializeRecaptcha();
                confirmationResult = await signInWithPhoneNumber(auth, phoneNumber, recaptchaVerifier);
                
                // Show the phone number being verified
                document.getElementById('phone-display').style.display = 'block';
                document.getElementById('phone-number-display').textContent = phoneNumber;
                
                // Enable OTP input and verify button
                document.getElementById('otp').disabled = false;
                document.getElementById('verify-otp-btn').disabled = false;
                
                alert("OTP sent to " + phoneNumber);
            } catch (error) {
                console.error("Error sending OTP:", error);
                alert(`Error: ${error.message}`);
                if (recaptchaVerifier) {
                    recaptchaVerifier.clear();
                }
            }
        });

        // Verify OTP button
        document.getElementById('verify-otp-btn').addEventListener('click', async () => {
            const code = document.getElementById('otp').value.trim();
            if (!code) {
                alert("Please enter the OTP");
                return;
            }

            try {
                await confirmationResult.confirm(code);
                document.getElementById('success').style.display = 'block';
                alert("Phone verified successfully!");
                
                // Redirect after successful verification
                // window.location.href = "/dashboard"; // Uncomment and modify as needed
            } catch (error) {
                console.error("Error verifying OTP:", error);
                alert("Invalid OTP or verification failed");
            }
        });
    </script>
</body>
</html>