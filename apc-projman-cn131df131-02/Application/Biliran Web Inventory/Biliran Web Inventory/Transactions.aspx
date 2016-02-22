<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Transactions.aspx.cs" Inherits="Biliran_Web_Inventory.Item_Inventory" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <style type="text/css">
        .style1
        {
            height: 19px;
        }
    </style>
</head>
<body>
<form id="form1" runat="server">
    <div>
    
        <asp:Label Font-Size = "30pt" ID="Label1" runat="server" 
            Text="Transactions"></asp:Label>
    
    </div>
                               <table border = true style="width:100%;">
                                   <tr>
                                       <td>
                                           Item Name</td>
                                           <td>Quantity</td>
                                           <td>Supplier</td>
                                       <td>
                                           Supplier ID</td>
                                       <td>
                                           Delivery Date</td>
                                           <td>Terms</td>
                                           <td>Prepared By</td>
                                           <td>Remarks</td>
                                           <td>Received By</td>
                                           <td>Cost</td>
                                           <td>Payment</td>
                                   </tr>
                                   <tr>
                                       <td>
                                           Mefenamic Acid</td>
                                       <td>
                                           1000</td>
                                       <td>
                                           Drugs Incorporated</td>
                                           <td>
                                               S123</td>
                                       <td>
                                           9/9/2016</td>
                                       <td>
                                           Full Payment</td>
                                                 &nbsp;</td>
                                       <td>
                                           Samantha Curtis</td>
                                           <td>
                                               &nbsp;</td>
                                       <td>
                                           Supplies Office</td>
                                       <td>
                                           25,000</td>
                                             <td>
                                                 Cash</td>

                                   </tr>
                                   <tr>
                                       <td>
                                           Clinical Furnishings</td>
                                       <td>
                                           100</td>
                                       <td>
                                           Ali Med Incorporated</td>
                                           <td>
                                               S124</td>
                                                 &nbsp;</td>
                                       <td>
                                           1/10/2017</td>
                                           <td>
                                               Quarterly</td>
                                       <td>
                                           Kenneth Dy</td>
                                       <td>
                                           1 year warranty</td>
                                             <td>
                                                 Supplies Office</td>
                                           <td>
                                               150,000</td>
                                             <td>
                                                 Cash/Check</td>
                                   </tr>

                                    </tr>
                                   <tr>
                                       <td class="style1">
                                           Wheel Chair</td>
                                       <td class="style1">
                                           50</td>
                                       <td class="style1">
                                           Ali Med Incorporated</td>
                                           <td class="style1">
                                               S125</td>
                                                 &nbsp;</td>
                                       <td class="style1">
                                           2/11/2017</td>
                                           <td class="style1">
                                               Quarterly</td>
                                       <td class="style1">
                                           Nicole Lazaro</td>
                                       <td class="style1">
                                           1 year warramty</td>
                                             <td class="style1">
                                                 Supplies Office</td>
                                           <td class="style1">
                                               100,000</td>
                                             <td class="style1">
                                                 Check</td>
                                   </tr>

                                    </tr>
                                   <tr>
                                       <td>
                                           Hand Sanitizer</td>
                                       <td>
                                           100</td>
                                       <td>
                                           Green Cross Philippines</td>
                                           <td>
                                               S126</td>
                                                 &nbsp;</td>
                                       <td>
                                           2/12/2017</td>
                                           <td>
                                               Full Payment</td>
                                       <td>
                                           Larry Reyes</td>
                                       <td>
                                           &nbsp;</td>
                                             <td>
                                                 Supplies Office</td>
                                           <td>
                                               10,000</td>
                                             <td>
                                                 Cash</td>
                                   </tr>
                               </table>
    <p>
        <asp:Button Font-Size = 10 ID="Button1" runat="server" Text="Add Transaction" 
            PostBackUrl="~/Add Transaction.aspx" Width="110px" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:Button Font-Size = 10 ID="Button3" runat="server" Text="Pending" 
            PostBackUrl="~/Pending.aspx" Width="110px" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:Button Font-Size = 10 ID="Button2" runat="server" Text="Back" 
            PostBackUrl="~/Supplies.aspx" Width="110px" />
    </p>
    </form>
                               </body>
</html>
