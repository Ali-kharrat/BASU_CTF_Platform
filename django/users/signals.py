from django.db.models.signals import post_save
from django.contrib.auth.models import User
from django.dispatch import receiver
from .models import Score, Team

@receiver(post_save, sender=Team)
def create_user_score(sender, instance, created, **kwargs):
    if created:
        Score.objects.create(team=instance)
