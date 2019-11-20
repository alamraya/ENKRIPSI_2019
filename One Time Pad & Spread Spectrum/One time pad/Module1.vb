Imports System.IO
Imports System.Security.Cryptography
Imports System.Text

Module Module1
    Sub Main()
        Console.WriteLine("Algoritma One-Time Pad")

        Console.WriteLine("Masukkan kalimat yang akan dienkrip: ")
        Dim input As String = Console.ReadLine
        Console.WriteLine("")

        Dim otp As New OneTimePad(input)
        Console.WriteLine("Kata Kunci yang digunakan adalah: " & vbCrLf & Convert.ToBase64String(otp.kataKunci) & vbCrLf)

        Dim hasilEnkripsi As String = otp.Encrypt(input)
        Console.WriteLine("Hasil enkripsi kalimat input adalah: " & vbCrLf & hasilEnkripsi.ToString & vbCrLf)

        Dim hasilDekripsi As String = otp.Decrypt(hasilEnkripsi)
        Console.WriteLine("Hasil dekripsi dari kalimat terenkripsi adalah: " & vbCrLf & hasilDekripsi & vbCrLf)

        otp.kataKunci = New Byte() {}

        Console.ReadLine()
    End Sub
End Module

Class OneTimePad
    Public kataKunci() As Byte

    Public Sub New(ByVal input As String)
        Dim jumlahGenerate As Integer = 100
        Dim jumlahPengambilanByte As Integer = jumlahGenerate
        Dim byteAcak As Byte() = New Byte(jumlahGenerate - 1) {}
        Dim rng As New RNGCryptoServiceProvider()

        kataKunci = New Byte(input.Length - 1) {}
        Dim idxInput As Integer = 0

        Dim idxStart As Long = 0
        While idxStart <= input.Length
            rng.GetBytes(byteAcak)
            If (idxStart + jumlahGenerate) > input.Length Then
                jumlahPengambilanByte = Convert.ToInt32(input.Length - idxStart)
            End If

            For i As Integer = 0 To jumlahPengambilanByte - 1
                kataKunci(idxInput) = byteAcak(i)
                idxInput += 1
            Next

            idxStart += jumlahGenerate
        End While
    End Sub

    Public Function Encrypt(src As String) As String
        Dim hasilEnkripsi(src.Length - 1) As Byte

        For i As Integer = 0 To src.Length - 1
            Dim tmp As Integer = AscW(src(i)) + kataKunci(i)
            If tmp > Byte.MaxValue Then tmp -= Byte.MaxValue
            hasilEnkripsi(i) = tmp
        Next

        Return Convert.ToBase64String(hasilEnkripsi)
    End Function

    Public Function Decrypt(src As String) As String
        Dim hasilEnkripsi() As Byte = Convert.FromBase64String(src)

        Dim hasilDekripsi(hasilEnkripsi.Length - 1) As Byte
        For i As Integer = 0 To hasilDekripsi.Length - 1
            Dim tmp As Integer = CInt(hasilEnkripsi(i)) - CInt(kataKunci(i))
            If tmp < Byte.MinValue Then tmp += Byte.MaxValue
            hasilDekripsi(i) = tmp
        Next

        Return Encoding.UTF8.GetString(hasilDekripsi.ToArray())
    End Function
End Class