using UnityEngine; 
using System.Collections; 
using System.Net;

public class server : MonoBehaviour {

  private string privateKey = "sdfgsdhsdhrhdf"; //same secret key as php
  private string saveDataUrl = "https://www.example.com/savedata.php?"; //your php server url
  private string loadDataUrl = "https://www.example.com/loaddata.php?"; //your php server url
  private string data1;
  private string data2;
  private string data3;
  private string data4;
  
  // Use this for initialization
  void Start () {
      data1 = "fgdfgfgh";
      data2 = "eeeeeee";
      data3 = "ggggg";
      data4 = "fdghncv";
      StartCoroutine(SaveData(data1, data2, data3, data4)); // save to server data first
      //StartCoroutine(LoadData(data1)); //then load data from server
  }
  
  IEnumerator SaveData(string data1, string data2, string data3, string data4)
  {
  
      string hash = Md5Sum(data1 + privateKey);
      WWW ScorePost = new WWW(saveDataUrl + "data1=" + data1 + "&data2=" + data2 + "&data3=" + data3 + "&data4=" + data4 + "&hash=" + hash);
      yield return ScorePost;
      if (ScorePost.error == null)
      {
          Debug.Log (ScorePost.text);
      }
      else
      {
          Debug.Log ("unable to update data:"+ScorePost.error);
      }
  }
  
  IEnumerator LoadData(string data1)
  {
      string hash = Md5Sum(data1 + privateKey);
      WWW GetScoresAttempt = new WWW (loadDataUrl + "data1=" + data1 + "&hash=" + hash);
      yield return GetScoresAttempt;
      if (GetScoresAttempt.error != null) {
          Debug.Log ("server is not reachable");
      } else {
          string[] textlist = GetScoresAttempt.text.Split (new string[]{"\n","\t"}, System.StringSplitOptions.RemoveEmptyEntries);
          for(int i=0; i<textlist.Length; i++) Debug.Log (textlist[i]);
      }
  }
  
  private string Md5Sum(string strToEncrypt)
  {
      System.Text.UTF8Encoding ue = new System.Text.UTF8Encoding();
      byte[] bytes = ue.GetBytes(strToEncrypt);
  
      System.Security.Cryptography.MD5CryptoServiceProvider md5 = new System.Security.Cryptography.MD5CryptoServiceProvider();
      byte[] hashBytes = md5.ComputeHash(bytes);
  
      string hashString = "";
  
      for (int i = 0; i < hashBytes.Length; i++)
      {
          hashString += System.Convert.ToString(hashBytes[i], 16).PadLeft(2, '0');
      }
  
      return hashString.PadLeft(32, '0');
  }
}
