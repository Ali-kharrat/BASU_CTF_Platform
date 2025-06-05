from django.contrib import admin
from .models import Score, Flag, SubmittedFlag, Team

admin.site.register(Score)
admin.site.register(Flag)
admin.site.register(SubmittedFlag)
admin.site.register(Team)

