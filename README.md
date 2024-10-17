# Employee QR-Data Gateway

## Overview

This project is a Python-based application designed to generate QR codes that redirect to the company's employee profile pages. Each QR code is customized with the company's logo at the center and matches the company's color theme. The application is user-friendly and requires only the employee ID to generate the QR code. The second part of the project consist the Team Manager App to manage the team members info accordingly.

## Features

- **QR Code Generation**: Generates a QR code containing a link to the employee's profile page.
- **Custom Branding**: The QR code is customized with Freightage Global Ltd.'s logo and color scheme.
- **Ease of Use**: The application has a simple interface, requiring only the employee ID to generate the QR code.
- **Distribution**: The project includes the original Python script, the webapp manager written in PHP

## Project Structure

- **Desktop Client**: Here remains the QR code generator, the python program to generate QR for an employee to link to the webapp.
- **Webapp**: The webapp files are provided here, This app manages the employee data and displays information upon proper GET requests from the generated QR codes.

## Requirements

- Python 3.x
- Required Python libraries: `qrcode`, `Pillow`, `customtkinter` (for compilation)

## How to Use

**Running the Python Script to use the QR Generator**:

- Clone the repository and navigate to the project directory.
- Install the required Python libraries to run the desktop client to generate QR codes for your employees:
  ```
  pip install -r requirements.txt
  ```
- Run the script:
  ```
  python main.py
  ```
- Input the employee ID when prompted to generate the QR code. Find the qr image in the folder named "Generated_qr" located in the installation directory.

**Running the Webapp to manage employee database**:

1. Configure the database by using schema.sql file
2. Configure the db.php and db_con.php credentials according to your database settings
3. Paste all the files in your server
4. Go to the URL and run the employee manager webapp

## Customization

If your company requires a similar application with custom branding and features, feel free to reach out. I can develop a tailored solution to meet your specific needs.

## License

This project is licensed under the MIT License.

## Contact

For any inquiries or requests, please contact me through my website: [www.maksud.xyz](https://www.maksud.xyz).

## Here are some screenshots of the application,

### Desktop Application

<br>

![image](https://github.com/user-attachments/assets/a2e6a56a-1f02-4752-a3f4-63748c939535)


---

![image](https://github.com/user-attachments/assets/873afc46-a5b6-4e4c-9ac5-f19973287ee8)

---

![image](https://github.com/user-attachments/assets/072ce2a0-e292-4ada-a919-a2b036b01024)

---

![image](https://github.com/user-attachments/assets/d5124768-26ee-4086-a8ee-810c2cca86c5)

---

### Web Application

<br>

![image](https://github.com/user-attachments/assets/d7613406-0965-419a-bd16-e90bfa62effc)

---

![image](https://github.com/user-attachments/assets/1b60008d-d80c-4bbd-b91c-93dcda82f625)

---

![image](https://github.com/user-attachments/assets/de0a0a36-ebe4-4ef2-863e-7520e5bacf7c)

---

![image](https://github.com/user-attachments/assets/0c598fbc-4c5b-4c13-a4d2-39837ed0a0a9)

---

![image](https://github.com/user-attachments/assets/e7663cd5-99ea-4618-a89e-aec098ff8b9b)

---

#### When QR Code is Scanned

![image](https://github.com/user-attachments/assets/7a624637-41f3-4d71-bcfb-347082e2faa5)



![After Scanning](https://github.com/user-attachments/assets/2929e22f-d298-4b97-bbf7-d4822648ceb5)
