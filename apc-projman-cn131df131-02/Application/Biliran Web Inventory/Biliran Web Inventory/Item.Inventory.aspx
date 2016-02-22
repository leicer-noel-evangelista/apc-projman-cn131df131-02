<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Item Inventory.aspx.cs" Inherits="Biliran_Web_Inventory.Transactions" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
    
        Item Inventory<br />
        <br />
        <table border=true style="width:100%;">
            <tr>
                <td>
                    Item Name</td>
                <td>
                    Forward ID Number</td>
                <td>
                    Department</td>
                    <td>Quantity</td>
                    <td>Date Forwaded</td>
                    <td>Issue Number</td>
                    <td>Patient</td>
            </tr>
            <tr>
                <td>
                    Hand Sanitizer</td>
                <td>
                    F123</td>
                <td>
                    Radiology</td>
                        <td>
                            5</td>
                <td>
                    5/26/2016</td>
                <td>
                    I1000</td>
                    <td>
                        &nbsp;</td>
            </tr>
            <tr>
                <td>
                    Gloves</td>
                <td>
                    F222</td>
                <td>
                    Intensive Care Unit</td>
                           <td>
                               20</td>
                <td>
                    1/1/2017</td>
                <td>
                    I2000</td>
                    <td>
                        Christopher Hernandez</td>
            </tr>

             <tr>
                <td>
                    Mefenamic Acid</td>
                <td>
                    F333</td>
                <td>
                    Emergency Room</td>
                           <td>
                               50</td>
                <td>
                    10/11/2017</td>
                <td>
                    I3000</td>
                    <td>
                        &nbsp;</td>
            </tr>

             <tr>
                <td>
                    Face Mask</td>
                <td>
                    F444</td>
                <td>
                    Intensive Care Unit</td>
                           <td>
                               50</td>
                <td>
                    8/19/2017</td>
                <td>
                    I4000</td>
                    <td>
                        James Yap</td>
            </tr>

             <tr>
                <td>
                    Sterilization and Sterilization Tray</td>
                <td>
                    F555</td>
                <td>
                    Pediatric Surgery</td>
                           <td>
                               10</td>
                <td>
                    10/10/2017</td>
                <td>
                    I5000</td>
                    <td>
                        &nbsp;</td>
            </tr>
        </table>
    
    </div>
    <p>
        <asp:Button Font-Size = 10 ID="Button1" runat="server" Text="Back" 
            PostBackUrl="~/Supplies.aspx" Width="110px" />
    </p>
    </form>
</body>
</html>
