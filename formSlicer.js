import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  fields: [],
};

const formSlice = createSlice({
  name: "form",
  initialState,
  reducers: {
    addField: (state, action) => {
      state.fields.push(action.payload);
    },
    updateField: (state, action) => {
      const { id, fieldData } = action.payload;
      const field = state.fields.find((f) => f.id === id);
      if (field) {
        Object.assign(field, fieldData);
      }
    },
  
  },
});

export const { addField, updateField } = formSlice.actions;
export default formSlice.reducer;
