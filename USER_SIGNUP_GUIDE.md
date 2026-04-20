# 🎓 MPSU Alumni Network - New User Signup Guide

## Quick Start

### 1. Access the Signup Page
Open your browser and go to:
```
http://localhost:8000/signup/step1
```

---

## Step 1️⃣ - User Information

Fill in your details:

**Full Name**
- Your complete name (required)
- Example: "Juan Dela Cruz"

**Contact Number** 
- Your mobile phone number (required)
- Format: 10 digits (e.g., 09161234567 or +63-916-123-4567)
- This is where you'll receive the OTP verification code

**Email Address**
- Your valid email (required and must be unique)
- Example: "juan@example.com"
- You'll use this to login later

**Course Graduated**
- Your degree program (required)
- Example: "Bachelor of Science in Information Technology"

**Year Graduated**
- Year you graduated (required)
- Must be between 1950 and current year
- Example: "2020"

**Password**
- Create a strong password (required)
- Must have:
  - At least 8 characters
  - At least one uppercase letter (A-Z)
  - At least one lowercase letter (a-z)
  - At least one number (0-9)
  - At least one special symbol (!@#$%^&*)
- Example: "MyPassword@2024"

**Confirm Password**
- Re-enter your password (required)
- Must match exactly

**Terms & Conditions**
- Must check the box to agree (required)
- Covers terms and privacy policy

### After Filling:
Click **"Continue to Verification"** button

---

## Step 2️⃣ - OTP Verification

After submitting Step 1, you'll be taken to the OTP verification page.

**What is OTP?**
OTP stands for "One-Time Password" - a 6-digit security code sent to your phone number.

**Receiving the OTP:**
1. Check your phone for an SMS with a 6-digit code
2. In development mode, the code is displayed on the page (for testing)
3. If you don't receive it, click "Resend OTP"

**Entering the OTP:**
1. Look at the phone number field - it shows a masked version of your number
2. Enter the 6-digit code you received
3. The code must be entered within 10 minutes
4. You have 3 attempts to enter the correct code

**Timer:**
- The countdown shows how much time you have left
- OTP expires after 10 minutes
- If it expires, click "Resend OTP" to get a new code

### After Entering OTP:
Click **"Verify OTP"** button

---

## Step 3️⃣ - Account Created! ✅

Once OTP is verified:
1. Your account is automatically created
2. Your alumni profile is set up
3. You're automatically logged in
4. You're redirected to your dashboard

**What happens next?**
- Your account is active and ready to use
- You can update your profile information
- You can apply for jobs
- You can register for events
- You can connect with other alumni

---

## 🆘 Troubleshooting

### "Invalid contact number"
- ✅ Make sure you enter 10 digits
- ✅ Use format: 09161234567 or +63-916-123-4567
- ✅ No spaces or special characters except dash and plus

### "Email already exists"
- ✅ This email is already registered
- ✅ Use a different email address
- ✅ Or use the login page if you already have an account

### "Password must contain..."
- ✅ Password needs uppercase (A-Z)
- ✅ Password needs lowercase (a-z)
- ✅ Password needs number (0-9)
- ✅ Password needs special symbol (!@#$%^&*)
- ✅ Minimum 8 characters

### "OTP not received"
- ✅ Check your phone's SMS inbox
- ✅ Check spam/junk folder
- ✅ Click "Resend OTP" for a new code
- ✅ Make sure phone number is correct

### "OTP expired"
- ✅ You have 10 minutes to enter the code
- ✅ Click "Resend OTP" to get a new code
- ✅ You'll need to start over from Step 1 if it expires

### "Maximum attempts exceeded"
- ✅ You've tried entering wrong OTP 3 times
- ✅ Click "Go Back" to start over
- ✅ You'll get a new OTP in Step 1

### "Session expired"
- ✅ You took too long to complete signup
- ✅ Go back to Step 1 and start again
- ✅ Session times out after 2 hours of inactivity

---

## ✨ After Signup

### Login with Your New Account
```
Email: your.email@example.com
Password: your-password-here
```

Go to: `http://localhost:8000/login`

### Your Dashboard Features
Once logged in, you can:
- ✅ View your alumni profile
- ✅ Update your information
- ✅ Browse job opportunities
- ✅ Register for events
- ✅ Read alumni news
- ✅ Connect with classmates
- ✅ Send messages

---

## 📋 Information Summary

Your account will store:
- Full name
- Email address
- Phone number
- Course you graduated from
- Year you graduated
- Batch/Cohort information (auto-linked)

This information helps the system:
- Organize alumni by batch
- Facilitate class connections
- Tailor job recommendations
- Send relevant news and events

---

## 🔐 Security Tips

1. **Protect Your Password**
   - Don't share with anyone
   - Use a unique password
   - Don't use birthdate or common words

2. **Keep Your Phone Number Updated**
   - Used for future OTP verification
   - Important for account recovery

3. **Use Secure Email**
   - Check your email regularly
   - Keep your email password secure

4. **Don't Share Your OTP**
   - Never share the 6-digit code
   - Only you should receive it

---

## 📞 Support

If you encounter issues:
1. Check the troubleshooting section above
2. Make sure JavaScript is enabled in your browser
3. Try a different browser if it doesn't work
4. Clear your browser cache and try again
5. Contact the MPSU Alumni Office

---

## ✅ Checklist Before You Start

- [ ] You have a valid email address
- [ ] You have your phone number handy
- [ ] You remember your graduation year
- [ ] You know your course name
- [ ] You can create a strong password
- [ ] You're ready to accept terms & conditions
- [ ] You can receive SMS on your phone

---

**Ready to sign up? Go to:** `http://localhost:8000/signup/step1`

Welcome to the MPSU Alumni Network! 🎓
