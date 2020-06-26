using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

using FireSharp.Config;
using FireSharp.Interfaces;
using FireSharp.Response;
using FireSharp;

public partial class FirebaseGuncelle : System.Web.UI.Page
{
    public string sLampStatus;
    protected void Page_Load(object sender, EventArgs e)
    {
        if (IsPostBack == false)
        {
            sLampStatus = Request.QueryString["LampStatus"];

            txtLampStatus.Text = sLampStatus;

            if (sLampStatus == "admin")
            {
                IFirebaseConfig config = new FirebaseConfig
                {
                    AuthSecret = "***************",
                    BasePath = "*************"
                };

                IFirebaseClient client = new FirebaseClient(config);
                SetResponse responsePush = client.Set("LampStatus", "admin");
            }

            if (sLampStatus == "user")
            {
                IFirebaseConfig config = new FirebaseConfig
                {
                    AuthSecret = "*********",
                    BasePath = "****************"
                };

                IFirebaseClient client = new FirebaseClient(config);
                SetResponse responsePush = client.Set("LampStatus", "user");
            }
            if (sLampStatus == "empty")
            {
                IFirebaseConfig config = new FirebaseConfig
                {
                    AuthSecret = "*************",
                    BasePath = "*********************"
                };

                IFirebaseClient client = new FirebaseClient(config);
                SetResponse responsePush = client.Set("LampStatus", "empty");
            }

        }
    }
}