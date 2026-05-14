from django.db import models

class Client(models.Model):
    name = models.CharField(max_length=100)
    email = models.EmailField()
    phone = models.CharField(max_length=20)
    company = models.CharField(max_length=100)
    status = models.CharField(max_length=50, default="Active")
    image = models.CharField(max_length=100, blank=True)

    def __str__(self):
        return self.name