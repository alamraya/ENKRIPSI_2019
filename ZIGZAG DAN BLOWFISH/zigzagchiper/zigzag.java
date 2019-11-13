import java.util.*;
class zigzagcipher{
 int depth;
 String Encryption(String plainText,int depth)throws Exception
 {
  int r=depth,len=plainText.length();
  int c=len/depth;
  char mat[][]=new char[r][c];
  int k=0;
   
  String cipherText="";
   
  for(int i=0;i< c;i++)
  {
   for(int j=0;j< r;j++)
   {
    if(k!=len)
     mat[j][i]=plainText.charAt(k++);
    else
     mat[j][i]='X';
   }
  }
  for(int i=0;i< r;i++)
  {
   for(int j=0;j< c;j++)
   {
    cipherText+=mat[i][j];
   }
  }
  return cipherText;
 }
  
  
 String Decryption(String cipherText,int depth)throws Exception
 {
  int r=depth,len=cipherText.length();
  int c=len/depth;
  char mat[][]=new char[r][c];
  int k=0;
   
  String plainText="";
   
   
  for(int i=0;i< r;i++)
  {
   for(int j=0;j< c;j++)
   {
    mat[i][j]=cipherText.charAt(k++);
   }
  }
  for(int i=0;i< c;i++)
  {
   for(int j=0;j< r;j++)
   {
    plainText+=mat[j][i];
   }
  }
   
  return plainText;
 }
}
 
class zigzag{
 public static void main(String args[])throws Exception
 {
  zigzagcipher rf=new zigzagcipher(); 
                Scanner scn=new Scanner(System.in);
                int depth;
   
                String plainText,cipherText,decryptedText;
                 
                System.out.println("Masukan plain text:");
                plainText=scn.nextLine();
                 
                System.out.println("Masukan nilai kunci");
                depth=scn.nextInt();
                
  cipherText=rf.Encryption(plainText,depth);
  System.out.println("\nHasil Enkripsi :\n"+cipherText);
                 
                decryptedText=rf.Decryption(cipherText, depth);
                 
  System.out.println("\nHasil Dekripsi :\n"+decryptedText);
   
 }
}