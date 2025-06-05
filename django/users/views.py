from django.shortcuts import render, redirect
from django.contrib.auth import login, authenticate, logout
from .forms import RegisterForm, LoginForm
from django.contrib.auth.decorators import login_required
from .models import Score
from .models import Flag, SubmittedFlag
from django.contrib import messages
from django.shortcuts import render, redirect
from django.contrib.auth.models import User
from .models import Team




def home_redirect(request):
    if request.user.is_authenticated:
        return redirect('dashboard')
    else:
        return redirect('login')
    
#def register_view(request):
#    if request.method == 'POST':
#        form = RegisterForm(request.POST)
#        if form.is_valid():
#            user = form.save(commit=False)
#            password = form.cleaned_data['password1']
 #           invite_code = form.cleaned_data['team_invite_code']
  #          team_name = form.cleaned_data['team_name']
#
 #           user.set_password(password)
  #          user.save()
#
 #           if invite_code:
  #              try:
   #                 team = Team.objects.get(team_id=invite_code)
    #                if not team.is_full():
     #                   team.members.add(user)
     #       else:
      #                  form.add_error('team_invite_code', 'This team is full')
       #                 user.delete()
        #                return render(request, 'breakingbad/register.html', {'form': form})
         #       except Team.DoesNotExist:
          #          form.add_error('team_invite_code', 'Invalid team code')
           #         user.delete()
            #        return render(request, 'breakingbad/register.html', {'form': form})
         #   else:
          #      if not team_name:
           #         form.add_error('team_name', 'Team name is required when creating a new team.')
            #        user.delete()
             #       return render(request, 'breakingbad/register.html', {'form': form})
              #  team = Team.objects.create(name=team_name, created_by=user)
               # team.members.add(user)
           # Score.objects.get_or_create(team=team, defaults={'points': 0})

            #return redirect('login')
    #else:
     #   form = RegisterForm()
    #return render(request, 'breakingbad/register.html', {'form': form})


def register_view(request):
    virtual_participation = False

    if request.method == 'POST':
        form = RegisterForm(request.POST)
        if form.is_valid():
            total_users = User.objects.count()
            if total_users >= 40:
                virtual_participation = True

            user = form.save(commit=False)
            password = form.cleaned_data['password1']
            invite_code = form.cleaned_data['team_invite_code']
            team_name = form.cleaned_data['team_name']

            user.set_password(password)
            user.save()

            if invite_code:
                try:
                    team = Team.objects.get(team_id=invite_code)
                    if not team.is_full():
                        team.members.add(user)
                    else:
                        form.add_error('team_invite_code', 'This team is full')
                        user.delete()
                        return render(request, 'breakingbad/register.html', {'form': form})
                except Team.DoesNotExist:
                    form.add_error('team_invite_code', 'Invalid team code')
                    user.delete()
                    return render(request, 'breakingbad/register.html', {'form': form})
            else:
                if not team_name:
                    form.add_error('team_name', 'Team name is required when creating a new team.')
                    user.delete()
                    return render(request, 'breakingbad/register.html', {'form': form})
                team = Team.objects.create(name=team_name, created_by=user, is_virtual=virtual_participation)
                team.members.add(user)

            Score.objects.get_or_create(team=team, defaults={'points': 0})
            return redirect('login')

    else:
        form = RegisterForm()

    return render(request, 'breakingbad/register.html', {'form': form, 'virtual_participation': virtual_participation})




def login_view(request):
    if request.method == 'POST':
        form = LoginForm(data=request.POST)
        if form.is_valid():
            user = form.get_user()
            login(request, user)
            return redirect('dashboard')
    else:
        form = LoginForm()
    return render(request, 'breakingbad/login.html', {'form': form})

def logout_view(request):
    logout(request)
    return redirect('login')



@login_required
def dashboard_view(request):
    user = request.user
    team = user.teams.first() if user.teams.exists() else None

    if team:
        try:
            team_score = Score.objects.get(team=team)
        except Score.DoesNotExist:
            team_score = Score.objects.create(team=team, points=0)
    else:
        team_score = None

    top_scores = Score.objects.order_by('-points', 'last_submit')

    context = {
        'team': team,
        'team_score': team_score,
        'top_scores': top_scores,
    }
    return render(request, 'breakingbad/dashboard.html', context)

    
    

@login_required
def submit_flag(request):
    if request.method == "POST":
        flag_input = request.POST.get('flag')
        try:
            flag_obj = Flag.objects.get(name=flag_input)

            already_submitted = SubmittedFlag.objects.filter(user=request.user, flag=flag_obj).exists()
            if not already_submitted:
                SubmittedFlag.objects.create(user=request.user, flag=flag_obj)

                team = Team.objects.filter(members=request.user).first()
                if team:
                    score, created = Score.objects.get_or_create(team=team)
                    score.points += flag_obj.points
                    score.save()
                    messages.success(request, f"✅ Correct flag! You earned {flag_obj.points} points.")
                else:
                    messages.error(request, "❌ You are not assigned to a team.")
            else:
                messages.warning(request, "⚠️ You have already submitted this flag.")

        except Flag.DoesNotExist:
            messages.error(request, "❌ Invalid flag. Try again!")

    return redirect('dashboard')
