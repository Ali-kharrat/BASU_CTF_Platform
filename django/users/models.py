from django.db import models
from django.contrib.auth.models import User
import uuid


class Team(models.Model):
    name = models.CharField(max_length=100)
    team_id = models.CharField(default=uuid.uuid4, unique=True, editable=False, max_length=200)
    created_by = models.OneToOneField(User, related_name='created_team', on_delete=models.CASCADE)
    members = models.ManyToManyField(User, related_name='teams')
    is_virtual = models.BooleanField(default=False) 

    def is_full(self):
        return self.members.count() >= 2

    def __str__(self):
        return f"{self.name} ({self.team_id})"

class Score(models.Model):
    team = models.OneToOneField(Team, on_delete=models.CASCADE)
    points = models.IntegerField(default=0)
    last_submit = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"{self.team.name} - {self.points} pts"



class Flag(models.Model):
    name = models.CharField(max_length=100, unique=True)  # مثلاً Flag{level1}
    points = models.IntegerField(default=10)

    def __str__(self):
        return self.name


class SubmittedFlag(models.Model):
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    flag = models.ForeignKey(Flag, on_delete=models.CASCADE)
    submitted_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        unique_together = ('user', 'flag')  
    def __str__(self):
        return f"{self.user.username} - {self.flag.name}"
    
    


