list = ["a","b",'c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z']
p = "zulfiaunyuunyu"
c = ""
d = ""
print("plantext : "+p)
for i in range(len(p)):
    a = (list.index(p[i])+3)%26
    c = c + list[a]
print("enkripsi : "+c)
for i in range(len(c)):
    a = (list.index(c[i])-3)%26
    d = d + list[a]
print("dekripsi : "+d+"\n")
nm = ""
no = 0
print("pemecahan enkripsi dengan teknik Brute Force : ")
for line in range(25):
    for l in range(len(c)):
        de = (list.index(c[l])-line)%26
        no = no + 1
        if no % len(c) == 0:
                nm = nm + list[de] + "\n"
        else: 
                nm = nm + list[de]
print(nm)
print("hello world")
print("hello world v2")
print("hello world v3")


