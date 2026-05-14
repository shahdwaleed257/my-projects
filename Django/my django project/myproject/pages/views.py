from django.shortcuts import render
from .models import Client

def home(request):
    return render(request, 'pages/index.html')

def clients(request):
    clients = Client.objects.all()
    return render(request, 'pages/clients.html', {'clients': clients})