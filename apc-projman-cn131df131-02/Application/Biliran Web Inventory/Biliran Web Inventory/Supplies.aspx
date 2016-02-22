<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Supplies.aspx.cs" Inherits="Biliran_Web_Inventory.WebForm2" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
    
        <asp:Label Font-Size = "30" ID="Label2" runat="server" 
            Text="Biliran Provincial Hospital Inventory Management System"></asp:Label>
        <br />
        <br />
        <asp:HyperLink Font-Underline = "False" Font-Size = "15pt" ID="HyperLink2" 
            runat="server" NavigateUrl="~/Supplier Information.aspx">Supplier Information</asp:HyperLink>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:HyperLink Font-Underline = "False" Font-Size = "15pt" ID="HyperLink3" 
            runat="server" NavigateUrl="~/Transactions.aspx">Transactions</asp:HyperLink>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:HyperLink Font-Underline = "False" Font-Size = "15pt" ID="HyperLink4" 
            runat="server" NavigateUrl="~/Item Inventory.aspx">Item Inventory</asp:HyperLink>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br />
        <br />
    
        <asp:Label Font-Size = "30pt" ID="Label1" runat="server" 
            Text="Supplies Inventory"></asp:Label>
        <br />
        <table border = true style="width: 100%; height: 93px;">
            <tr>
                <td colspan="0" rowspan="0">
                    Item Name</td>
                <td>
                    Item ID</td>
                <td>
                    Item Code</td>
                    <td>
                        Quantity Per Box</td>
                        <td>Quantity
                        </td>
                        <td>Product Code</td>
                        <td>Price Per Box</td>
                        <td>Expiry</td>
                        <td>Description</td>
                        <td>Supplier</td>
            </tr>
            <tr>
                <td>
                    Alaxan Forte</td>
                <td>
                    G1111</td>
                <td>
                    GX1X1</td>
                    <td>
                        30</td>
                <td>
                    100</td>
                    <td>
                        P3000</td>
                <td>
                    400</td>
                    <td>
                        3/15/2016</td>
                <td>
                    Medicinal Tablet</td>
                        <td>
                            Alaxan Philippines</td>
            </tr>
            <tr>
                <td>
                    Medicol</td>
                <td>
                    G2222</td>
                <td>
                    GX2X2</td>
                        <td>
                            40</td>
                        <td>
                            300</td>
                        <td>
                            P3001</td>
                        <td>
                            500</td>
                        <td>
                            8/15/2017</td>
                        <td>
                            Medicinal Capsule</td>
                        <td>
                            Medicol Philippines</td>
            </tr>
    <td>Gloves</td>
    <td>G3333</td>
    <td>GX3X3</td>
    <td>50</td>
    <td>250</td>
    <td>P3002</td>
    <td>600</td>
    <td>&nbsp;</td>
    <td>Hand Gloves</td>
    <td>Medical Supplies Philippines</td>

            <tr>
    <td>Face Mask</td>
    <td>G4444</td>
    <td>GX4X4</td>
    <td>30</td>
    <td>100</td>
    <td>P3003</td>
    <td>280</td>
    <td></td>
    <td>Facial Mask</td>
    <td>Medical Supplies Philippines</td>


            </tr>
            <tr>
    <td>Hand Sanitizer</td>
    <td>G5555</td>
    <td>GX5X5</td>
    <td>100</td>
    <td>150</td>
    <td>P3004</td>
    <td>10000</td>
    <td>7/1/2019</td>
    <td>Hand Sanitizer</td>
    <td>
        Medical Supplies Philippines</td>
            </tr>

    

        </table>
        <br />
        <asp:Button Font-Size = 10 ID="Button1" runat="server" Text="Add Supplies" 
            PostBackUrl="~/Add Supplies.aspx" Width="110px" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:Button Font-Size = 10 ID="Button2" runat="server" Text="Forward Supplies" 
            Width="110px" PostBackUrl="~/Forward Supplies.aspx" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <asp:Button Font-Size = 10 ID="Button3" runat="server" Text="Return Supplies" 
            Width="110px" PostBackUrl="~/Return Supplies.aspx" Height="26px" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<asp:Button 
            Font-Size = 10 ID="Button4" runat="server" Text="Update Supplies" 
            Width="110px" PostBackUrl="~/Update Supplies.aspx" Height="26px" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br />
    
    </div>
    </form>
</body>
</html>
