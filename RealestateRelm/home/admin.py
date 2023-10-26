from django.contrib import admin
from .models import home_rent
from .models import feedback_from_user
# Register your models here.

admin.site.register(home_rent)
admin.site.register(feedback_from_user)