from django.db import models

# Create your models here.
class home_rent(models.Model):
    home_img=models.ImageField(upload_to='home/static/images/')
    img_2=models.ImageField(upload_to='home/static/images',default="")
    img_3=models.ImageField(upload_to='home/static/images/',default="")
    img_4=models.ImageField(upload_to='home/static/images',default="")
    img_5=models.ImageField(upload_to='home/static/images/',default="")
    home_price=models.IntegerField()
    home_desc=models.CharField(max_length=500)
    location=models.CharField(max_length=100)
    home_address=models.CharField(max_length=500)
    home_type=models.CharField(max_length=50)
    
class feedback_from_user(models.Model):
    f1=models.CharField(max_length=1000)