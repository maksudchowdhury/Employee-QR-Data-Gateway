# C:\Users\Maksud\.virtualenvs\freightage_qr_code_generator-T0SIlcyG\Lib\site-packages\customtkinter
#packages customtkinter, pillow, qrcode
import customtkinter
from PIL import Image
import tkinter.messagebox
import qrcodeMaker
from qrcodeMaker import webDomain,subDirectory,pageName,getRequestCommand

base_url=webDomain+subDirectory+pageName+getRequestCommand
customtkinter.set_appearance_mode("dark")
customtkinter.set_default_color_theme("blue")

def button_callback():
    
    qrcodeMaker.makeQR(id.get())
    tkinter.messagebox.showinfo("Successful",f"The qr code has been generated successfully\nEmployee ID - {id.get()}")

app = customtkinter.CTk()
app.iconbitmap("./assets/system_logo.ico")
app.title("Employee QR Generator")
app.geometry("600x400")
app.resizable(False, False)
app.grid_columnconfigure(0, weight=1)
app.grid_columnconfigure(1, weight=3)
app.grid_rowconfigure(0, weight=2)
app.grid_rowconfigure(1, weight=1)

logo = customtkinter.CTkImage(light_image=Image.open('./assets/system_logo.png'),dark_image=Image.open('./assets/system_logo.png'),size=(256,256)) # WidthxHeight
logoLabel=customtkinter.CTkLabel(app,image=logo,text="")
logoLabel.grid(row=0,column=0,columnspan=2,sticky="new",pady=5)


title= customtkinter.CTkLabel(app,text=base_url)
title.grid(row=0, column=0, padx=5, pady=10,sticky="se")

id = customtkinter.CTkEntry(app, placeholder_text="Enter the ID only")
id.grid(row=0, column=1, padx=30, pady=10, sticky="sew")


button = customtkinter.CTkButton(app, text="Generate QR", command=button_callback)
button.grid(row=1, column=0, columnspan=2, padx=30, pady=20,sticky="nwe")

credit= customtkinter.CTkLabel(app,text="© Maksud Chowdhury | www.maksud.xyz")
credit.grid(row=1, column=0,columnspan=2, padx=5, pady=5, sticky="s")



app.mainloop()