package com.programmer.kios.sigkabbantul.maps;

import android.content.Intent;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.programmer.kios.sigkabbantul.DetailActivity;
import com.programmer.kios.sigkabbantul.MainActivity;
import com.programmer.kios.sigkabbantul.R;
import com.programmer.kios.sigkabbantul.app.AppController;
import com.programmer.kios.sigkabbantul.app.Koneksi;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class All extends Fragment implements OnMapReadyCallback {



    SupportMapFragment mapFragment;
    GoogleMap gMap;
    MarkerOptions markerOptions = new MarkerOptions();
    CameraPosition cameraPosition;
    LatLng center, latLng;
    String title;
    Double lat, lng;

    Button btn1,btn2,btn3,btn4,btn5;

    public static final String ID = "id";
    public static final String TITLE = "id";
    public static final String LAT = "lat";
    public static final String LNG = "lng";

    String tag_json_obj = "json_obj_req";
    Koneksi con = new Koneksi();
    private String url = con.BASE_URL + "maps_marker.php?kat=0";
    public static All newInstance() {
        return new All();
    }


    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.map_layout, null);



        mapFragment = (SupportMapFragment)getChildFragmentManager().findFragmentById(R.id.map_wisata);
        mapFragment.getMapAsync(this);

        return v;
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        gMap = googleMap;

        // Mengarahkan ke Pasar Seni Gabusan
        center = new LatLng(-7.8777778,110.3488425);
        cameraPosition = new CameraPosition.Builder().target(center).zoom(10).build();
        googleMap.animateCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));


        getMarkers();
    }
    private void addMarker(LatLng latlng, final String title) {
        markerOptions.position(latlng);
        markerOptions.title(title);
        gMap.addMarker(markerOptions);

        //pindah ke detail
        gMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener(){
            @Override
            public boolean onMarkerClick(Marker marker) {
                if (marker != null && marker.getTitle().equals(markerOptions.getTitle().toString()))
                    ;
                Intent intent = new Intent(getActivity(), DetailMap.class);
                intent.putExtra("id", marker.getTitle());
                startActivity(intent);

                return true;
            }
            });
    }

    private void getMarkers() {
        StringRequest strReq = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                Log.e("Response: ", response.toString());

                try {
                    JSONObject jObj = new JSONObject(response);
                    String getObject = jObj.getString("wisata");
                    JSONArray jsonArray = new JSONArray(getObject);

                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject jsonObject = jsonArray.getJSONObject(i);
                        title = jsonObject.getString(TITLE);
                        lat = jsonObject.getDouble(LAT);
                        lng = jsonObject.getDouble(LNG);
                        latLng = new LatLng(Double.parseDouble(jsonObject.getString(LAT)), Double.parseDouble(jsonObject.getString(LNG)));

                        // Menambah data marker untuk di tampilkan ke google map
                        addMarker(latLng, title);
                    }

                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("Error: ", error.getMessage());
                Toast.makeText(getActivity(), error.getMessage(), Toast.LENGTH_LONG).show();
            }
        });

        AppController.getInstance().addToRequestQueue(strReq, tag_json_obj);
    }


}
