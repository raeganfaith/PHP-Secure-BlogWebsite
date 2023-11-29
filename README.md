<div align="center">
  <h1>🔒THREAT MODELING</h1>
</div>

## Identifying Security Objective

| Business Case  | Description |
| --- | --- |
| Company and Industry  | PawTalk Inc. - Education |
| Solution Requirements | The web application must be developed using secure coding practices. |
| Compliance Requirements | Create, read, update, and delete (CRUD) functionality must be implemented in the web application, and both the user and admin pages need to acknowledge policy and security. |
| Quality of Service Requirements | Availability: The service of the web application must only be accessible to Nationalian admin and users. <br> <br> Reliability: The service of the web application must be responsive to mobile and desktop devices without errors. <br> <br> Reliability: The service of the web application must be responsive to mobile and desktop devices without errors.|
| Assets | Files: HTML, CSS, and JavaScript <br> <br> Database: PHP <br> <br> Other assets: Images, logo, and contents |
| Security Objective | To develop a safe web application for users to post comments without being vulnerable to threats.  |

# Secure Coding Practices
## Input Validation, Authentication and Password Management

☑️ Require password combination (Sign Up) <br>
☑️ Require email validation (Sign Up) <br>
☑️ Require value input (Sign Up) <br>
☑️ Confirm password match authentication (Sign Up) <br>
☑️ No email repetition (Sign Up) <br>
☑️ No username repetition (Sign Up) <br>
☑️ Validate user input (Sin In) <br>
☑️ Validate if user exists. <br>
☑️ Validate if user or admin (Sign In) <br>
☑️ Password authentication (Sign In) <br>
☑️ Username and email validation (Sign In) <br>

## Session Management and Access Control

☑️ Admin and User Session <br>
☑️ Users can post content during their session <br>
☑️ Reflection of current user in the session <br>
☑️ Admin and User Access <br>
☑️ Only logged in users are eligible to post content <br>

## Data Protection, Error Handling, and Logging Overview Snippet

☑️ Hashed user and admin password in the database <br>
☑️ Sign-Up forms data error handling <br>
☑️ Login and access attempts  <br>
☑️ Login error handling <br>

# Server Hardening Technique
## System Vulnerability Checklist

| Alert Name | Recommended Web Security Hardening Technique |
| --- | --- |
| Cross-Site Scripting | Disable Trace HTTP Request <br> Enable/Disable Mod Security <br> Modules X-XSS Protection |
| Parameter Tampering | Restrict IP Access |
| Server Leaks Information via “X-Powered by” HTTP Responsive Header Set | Set Cookie with HttpOnly and Secure Flag |
| Content Security Policy (CSP) Header Not Set | Disable ETag |
| Missing Anti-clickjacking Header, X-Content-TypeOptions Header Missing | Avoid Clickjacking Attack |
