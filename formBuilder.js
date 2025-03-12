import React, { useState } from "react";

const FormBuilder = () => {
  // Each field holds its configuration (label, name, type, validation, etc.)
  const [fields, setFields] = useState([]);

  // Adds a new empty field configuration
  const addField = () => {
    const newField = {
      id: fields.length + 1,
      label: "",
      name: "",
      type: "",
      required: false,
      minLength: "",
      maxLength: "",
      pattern: "",
      options: [], // For select and radio types
    };
    setFields([...fields, newField]);
  };

  // Generic update for field properties
  const updateField = (id, key, value) => {
    setFields(
      fields.map((field) =>
        field.id === id ? { ...field, [key]: value } : field
      )
    );
  };

  // Adds a new option for select/radio fields
  const addOption = (id) => {
    setFields(
      fields.map((field) => {
        if (field.id === id) {
          return { ...field, options: [...field.options, ""] };
        }
        return field;
      })
    );
  };

  // Update a specific option by index
  const updateOption = (id, index, value) => {
    setFields(
      fields.map((field) => {
        if (field.id === id) {
          const newOptions = field.options.map((opt, idx) =>
            idx === index ? value : opt
          );
          return { ...field, options: newOptions };
        }
        return field;
      })
    );
  };

  
  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Form configuration:", fields);
    
  };

  return (
    <form onSubmit={handleSubmit}>
      {fields.map((field) => (
        <div
          key={field.id}
          style={{
            border: "1px solid #ccc",
            padding: "10px",
            margin: "10px 0",
          }}
        >
          <input
            type="text"
            placeholder="Field Label"
            value={field.label}
            onChange={(e) => updateField(field.id, "label", e.target.value)}
            required
          />
          <input
            type="text"
            placeholder="Field Name"
            value={field.name}
            onChange={(e) => updateField(field.id, "name", e.target.value)}
            required
          />
          <select
            value={field.type}
            onChange={(e) => updateField(field.id, "type", e.target.value)}
            required
          >
            <option value="" disabled>
              Select type
            </option>
            <option value="text">Text</option>
            <option value="password">Password</option>
            <option value="email">Email</option>
            <option value="date">Date</option>
            <option value="select">Select</option>
            <option value="radio">Radio</option>
          </select>

          {/* Render additional attributes based on field type */}
          {(field.type === "text" || field.type === "password") && (
            <>
              <select
                value={field.required ? "required" : ""}
                onChange={(e) =>
                  updateField(
                    field.id,
                    "required",
                    e.target.value === "required"
                  )
                }
                required
              >
                <option value="required">Required</option>
                <option value="">Not Required</option>
              </select>
              <input
                type="number"
                placeholder="Min Length"
                value={field.minLength}
                onChange={(e) =>
                  updateField(field.id, "minLength", e.target.value)
                }
                required
              />
              <input
                type="number"
                placeholder="Max Length"
                value={field.maxLength}
                onChange={(e) =>
                  updateField(field.id, "maxLength", e.target.value)
                }
                required
              />
              <input
                type="text"
                placeholder="Pattern (Regex)"
                value={field.pattern}
                onChange={(e) =>
                  updateField(field.id, "pattern", e.target.value)
                }
                required
              />
            </>
          )}

          {(field.type === "select" || field.type === "radio") && (
            <>
              <select
                value={field.required ? "required" : ""}
                onChange={(e) =>
                  updateField(
                    field.id,
                    "required",
                    e.target.value === "required"
                  )
                }
                required
              >
                <option value="required">Required</option>
                <option value="">Not Required</option>
              </select>
              <button type="button" onClick={() => addOption(field.id)}>
                Add Option
              </button>
              {field.options.map((option, idx) => (
                <input
                  key={idx}
                  type="text"
                  placeholder={`Option ${idx + 1}`}
                  value={option}
                  onChange={(e) => updateOption(field.id, idx, e.target.value)}
                  required
                />
              ))}
            </>
          )}

          {(field.type === "email" || field.type === "date") && (
            <select
              value={field.required ? "required" : ""}
              onChange={(e) =>
                updateField(field.id, "required", e.target.value === "required")
              }
              required
            >
              <option value="required">Required</option>
              <option value="">Not Required</option>
            </select>
          )}
        </div>
      ))}

      <button type="button" onClick={addField}>
        Add a Field
      </button>
      <button type="submit">Create Code</button>
    </form>
  );
};

export default FormBuilder;
