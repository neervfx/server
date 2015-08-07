//	The MIT License (MIT)
//	
//	Copyright (c) 2015 neervfx
//		
//	Permission is hereby granted, free of charge, to any person obtaining a copy
//	of this software and associated documentation files (the "Software"), to deal
//	in the Software without restriction, including without limitation the rights
//	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//	copies of the Software, and to permit persons to whom the Software is
//	furnished to do so, subject to the following conditions:
//		
//	The above copyright notice and this permission notice shall be included in all
//	copies or substantial portions of the Software.
//		
//	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
//	SOFTWARE.

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
