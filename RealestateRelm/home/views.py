from django.shortcuts import render,get_object_or_404
from .models import home_rent
from .models import feedback_from_user
# Create your views here.

def home(request):
    return render(request,"home.html")

def rent(request):
    search=request.POST.get("searchhome")
    if search:
        data=home_rent.objects.filter(location__icontains=search)
    else:
        data=home_rent.objects.all()
    return render(request,"rent.html",{"data":data})

def buy_and_sell(request):
    if request.method=="POST":
        if request.method=="POST":
            c_image=request.FILES["cover_image"]
            img1=request.FILES["img1"]
            img2=request.FILES["img2"]
            img3=request.FILES["img3"]
            img4=request.FILES["img4"]
            description=request.POST.get("description")
            addr=request.POST.get("address")
            price=request.POST.get("price")
            location_by_file=request.POST.get("location_by_file")
            type=request.POST.get("type_of_house")
            data_save_to_db=home_rent(home_img=c_image,img_2=img1,img_3=img2,img_4=img3,img_5=img4,home_price=price,home_desc=description,location=location_by_file,home_address=addr,home_type=type)
            data_save_to_db.save()
    return render(request,"buy&sell.html")

def feedback(request):
    if request.method=="POST":
        user_fb=request.POST.get("fb")
        database_store=feedback_from_user(f1=user_fb)
        database_store.save()
    data=feedback_from_user.objects.all()
    return render(request,"feedback.html",{"data":data})

def about_us(request):
    return render(request,"about_us.html")


def detail(request):
    data=home_rent.objects.all()
    return render(request,"rent.html",{"data":data})

def availd(request,movie_id):
    home=get_object_or_404(home_rent,pk=movie_id)
    return render(request,"rentd.html",{'home':home})