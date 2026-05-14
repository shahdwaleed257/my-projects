def func(x):
    return x**3-7*x*x+14*x-6
def Bisection(a,b):
    if (func(b)*func(a)>0):
        print("false")
        return
    p=(a+b)/2
    print(f'{a:0.4f}{b:0.4f}{p:0.4f}{func(p):0.6f}')
    p=(a+b)/2
    if(func(a)*func(p)<0):
        b=p
    else:
        a=p
    print ('The value of root is%0.6f'%p)

Bisection(-1,2)          
            
