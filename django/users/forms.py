from django import forms
from django.contrib.auth.forms import UserCreationForm, AuthenticationForm
from django.contrib.auth.models import User

class RegisterForm(UserCreationForm):
    team_invite_code = forms.CharField(required=False, label="if you have Team Code paste here else skip")
    team_name = forms.CharField(required=False, label="Team Name")
    
    class Meta:
        model = User
        fields = ['username', 'email', 'password1', 'password2', 'team_invite_code', 'team_name']

class LoginForm(AuthenticationForm):
    username = forms.CharField(label="Username")
    password = forms.CharField(label="Password", widget=forms.PasswordInput)


