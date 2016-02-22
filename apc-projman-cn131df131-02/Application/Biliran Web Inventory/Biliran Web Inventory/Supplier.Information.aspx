<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Supplier Information.aspx.cs" Inherits="Biliran_Web_Inventory.Supplier_Information" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
<form id="form1" runat="server">
    <div>
    
        <asp:Label Font-Size = "30pt" ID="Label1" runat="server" 
            Text="Supplier Information"></asp:Label>
    
    </div>
                <table border = true style="width:100%;">
                    <tr>
                        <td>
                            Supplier Name</td>
                        <td>
                            Supplier ID</td>
                        <td>
                            Supplier Code</td>
                            <td>
                                Address</td>
                        <td>
                            Telephone Number 1</td>
                        <td>
                            Telephone Number 2</td>
                             <td>
                                 Email Address</td>
                                 <td>Status</td>
                    </tr>
                    <tr>
                        <td>
                            Alaxan Philippines</td>
                        <td>
                            2016-1001</td>
                        <td>
                            P123</td>
                                 <td>
                                     Tondo Manila City</td>
                        <td>
                            111 11 11</td>
                        <td>
                            555 55 55</td>
                             <td>
                                 alaxanph@gmail.com</td>
                                 <td>Active</td>
                    </tr>
                    <tr>
                        <td>
                            Medicol Philippines</td>
                        <td>
                            2017-1002</td>
                        <td>
                            P456</td>
                                 <td>
                                     Sucat Paranaque City</td>
                        <td>
                            222 22 22</td>
                        <td>
                            666 66 66</td>
                             <td>
                                 medicolph@yahoo.com</td>
                                 <td>Active</td>
                    </tr>
                    <tr>
                        <td>
                            Medical Supplies Philippines</td>
                        <td>
                            2017-1003</td>
                        <td>
                            P789</td>
                                 <td>
                                     Puerto Prinsesa Palawan</td>
                        <td>
                            333 33 33</td>
                        <td>
                            777 77 77</td>
                             <td>
                                 medicalsuppliesph@gmail.com</td>
                                 <td>Inactive</td>
                    </tr>
                    <tr>
                        <td>
                            Green Cross</td>
                        <td>
                            2018-1004</td>
                        <td>
                            P111</td>
                                 <td>
                                     General Santos City Mindanao</td>
                        <td>
                            444 44 44</td>
                        <td>
                            &nbsp;</td>
                             <td>
                                 greencrossph@greencross.ph</td>
                                 <td>Active</td>
                    </tr>
                </table>
    <p>
        <asp:Button Font-Size = 10 ID="Button1" runat="server" Text="Add Supplier" 
            PostBackUrl="~/Add Supplier.aspx" Width="110px" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:Button Font-Size = 10 ID="Button2" runat="server" Text="Update Supplier" 
            Width="110px" PostBackUrl="~/Update Supplier.aspx" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:Button Font-Size = 10 ID="Button3" runat="server" Text="Back" 
            Width="110px" PostBackUrl="~/Supplies.aspx" Height="26px" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    </form>
                </body>
</html>
