
import tkinter as tk
from tkinter import messagebox
import numpy as np
import tensorflow as tf

# تحميل النموذج المحول إلى TFLite
interpreter = tf.lite.Interpreter(model_path="medical_diagnosis_model.tflite")
interpreter.allocate_tensors()

# الحصول على المدخلات والمخرجات من النموذج
input_details = interpreter.get_input_details()
output_details = interpreter.get_output_details()

# تعريف الأعراض مع الأسماء
symptom_names = ["ارتفاع درجة الحرارة", "سعال", "صداع", "إسهال"]

# دالة لتشغيل التشخيص
def diagnose(symptoms):
    symptoms_array = np.array([symptoms], dtype=np.float32)
    interpreter.set_tensor(input_details[0]['index'], symptoms_array)
    interpreter.invoke()
    output_data = interpreter.get_tensor(output_details[0]['index'])
    diagnosis = np.argmax(output_data[0])

    # تحديد التشخيص بناءً على النتيجة
    if diagnosis == 0:
        return "إنفلونزا"
    elif diagnosis == 1:
        return "صداع نصفي"
    elif diagnosis == 2:
        return "تسمم غذائي"
    else:
        return "تشخيص غير معروف"

# إنشاء واجهة المستخدم باستخدام Tkinter
class DiagnosisApp:
    def __init__(self, root):
        self.root = root
        self.root.title("تطبيق التشخيص الطبي")
        
        # إضافة عنوان التطبيق
        self.title_label = tk.Label(root, text="أدخل الأعراض لتشخيص المرض:", font=("Arial", 16))
        self.title_label.pack(pady=20)

        # إضافة الأعراض كـ Checkboxes
        self.symptoms = []
        for symptom in symptom_names:
            var = tk.IntVar()
            checkbox = tk.Checkbutton(root, text=symptom, variable=var)
            checkbox.pack()
            self.symptoms.append(var)

        # زر التشخيص
        self.diagnose_button = tk.Button(root, text="تشخيص", font=("Arial", 14), command=self.diagnose)
        self.diagnose_button.pack(pady=20)

    def diagnose(self):
        # جمع الأعراض المدخلة
        symptoms_values = [var.get() for var in self.symptoms]

        # تشخيص المرض
        diagnosis = diagnose(symptoms_values)

        # عرض النتيجة في نافذة منبثقة
        messagebox.showinfo("التشخيص", f"التشخيص: {diagnosis}")


# إنشاء النافذة الرئيسية
root = tk.Tk()

# إنشاء التطبيق
app = DiagnosisApp(root)

# تشغيل التطبيق
root.mainloop()

